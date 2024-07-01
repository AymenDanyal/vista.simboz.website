<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Wishlist;
use App\Models\Post;
use App\Models\Filter;
use App\Models\Brand;
use App\Models\FilterCategory;
use App\Models\FilterValue;
use App\Models\FilterParameter;
use App\User;
use Auth;
use Session;
use Newsletter;
use DB;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
class FrontendController extends Controller
{
   
    public function index(Request $request){
        return redirect()->route($request->user()->role);
    }
    public function home(){


        //for($i=50;$i<60;$i++) {
    
        //         Product::create([
        //             'title' => "Product Title",
        //             'summary' => "Product Summary",
        //             'slug' => Str::slug("Product title".$i), 
        //             'photo' =>'https://htmlbeans.com/html/schon/images/products/img22.jpg' , 
        //             'stock' => $i,
        //             'price' => $i,
        //             'discount' => $i,
        //             'status' => 'inactive', 
        //             'description' => "Product Description that will be uploaded",  
        //             'cat_id'=>'12',
        //             'is_featured' => false,  
                    
        //         ]);

        //         echo "Inserted into database. <br>";
        //     }
        //     return 'Images processed successfully.';  
        // }

        
    


        $featured=Product::where('status','active')->where('is_featured',1)->limit(8)->get();
        $bestSellers=Product::where('status','active')->orderBy('stock','desc')->limit(8)->get();
        $latests=Product::where('status','active')->orderBy('created_at','desc')->limit(8)->get();
        $posts=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $banners=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        // return $banner;
        $products=Product::where('status','active')->orderBy('id','DESC')->limit(8)->get();
        $category=Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
      
       //dd($latest);
        // return $banners;
        return view('frontend.index')
                ->with('featured',$featured)
                ->with('bestSellers',$bestSellers)
                ->with('latests',$latests)
                ->with('posts',$posts)
                ->with('banners',$banners)
                ->with('product_lists',$products)
                ->with('category_lists',$category);
    }   
    public function aboutUs(){
        return view('frontend.pages.about-us');
    }
    public function contact(){
        return view('frontend.pages.contact');
    }

    public function productGrids($cat_id) {
    
        if ($cat_id == 0) {
            // Get all products and paginate the results with 16 per page
            $products = Product::paginate(16);
        } else {
            // Get products where 'cat_id' matches $cat_id and paginate the results with 16 per page
            $products = Product::where('cat_id', $cat_id)->paginate(16);
         
        }
    
        // Fetch all parent categories with their child categories
        $categories = Category::where('id', $cat_id)->first();
        
        // Pass the total number of products, the number currently being shown, and the total number of pages to the view
        $totalProducts = $products->total();
        $currentShowing = $products->count();
        $totalPages = $products->lastPage();
        
         //  dd($tags);
      

        $filterCategories = FilterCategory::where('cat_id', $cat_id)
        ->with(['filter' => function($query) {
            $query->with('parameters');
        }])
        ->get();

    
       
        $filterArray = [];
        foreach ($filterCategories as $filterCategory) {
            $filter = $filterCategory->filter;
            foreach ($filter as $f) {
                if ($filter) {
                    $filterArray[] = [
                        'filter_id' => $f->filter_id,
                        'filter_name' => $f->filter_name,
                        'parameters' => $f->parameters->pluck('param_value','param_id')
                    ];
                }
            }
        }
        //dd($filterArray);
        return view('frontend.pages.product-grids', compact('products', 'categories', 'totalProducts', 'currentShowing', 'totalPages','filterArray','cat_id'));
    }
    public function productSearch(Request $request)
{
    try {
        $filterId = $request->input('filterId', []);
        $paramId = $request->input('paramId', []);
        $categoryId = $request->input('categoryId');
        $search = $request->input('search');

        // Record the start time
        $startTime = microtime(true);

        // Initialize the query
        $query = Product::query();

        // Scenario 1: Filter by categoryId only
        if (!empty($categoryId) && empty($paramId) && empty($search)) {
            $query->where('cat_id', $categoryId);
        }
        // Scenario 2: Filter by categoryId and paramId
        elseif (!empty($categoryId) && !empty($paramId) && empty($search)) {
            $query->where('cat_id', $categoryId)
                  ->whereHas('filterValues', function ($q) use ($filterId, $paramId) {
                      $q->whereIn('filter_id', $filterId)
                        ->whereIn('param_id', $paramId);
                  });
        }
        // Scenario 3: Search by term
        elseif (!empty($search) && empty($categoryId) && empty($paramId)) {
            // Search for matching categories
            $categoryIds = Category::where('title', 'like', '%' . $search . '%')
                                   ->pluck('id')
                                   ->toArray();

            // Search for products matching the search term or category IDs
            $query->where(function ($q) use ($search, $categoryIds) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('slug', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('summary', 'like', '%' . $search . '%')
                  ->orWhere('price', 'like', '%' . $search . '%');

                // Include products with matching category IDs
                if (!empty($categoryIds)) {
                    $q->orWhereIn('cat_id', $categoryIds);
                }
            });
        }

        // Paginate the results
        $products = $query->orderBy('id', 'DESC')->paginate(16);

        // Record the end time
        $endTime = microtime(true);

        // Calculate the response time in milliseconds
        $responseTime = ($endTime - $startTime) * 1000;

        return response()->json([
            'current_page' => $products->currentPage(),
            'data' => $products->items(),
            'length' => count($products->items()),
            'from' => $products->firstItem(),
            'last_page' => $products->lastPage(),
            'per_page' => $products->perPage(),
            'to' => $products->lastItem(),
            'total' => $products->total(),
            'response_time_ms' => $responseTime,
        ], 200); // HTTP status code 200 for success

    } catch (\Exception $e) {
        // Log the error
        Log::error('Product search error: ' . $e->getMessage());

        return response()->json([
            'message' => 'An error occurred while processing your request.',
            'error' => $e->getMessage(),
        ], 500); // HTTP status code 500 for internal server error
    }
}
    public function productDetail($slug){
        
        $product_detail = Product::getProductBySlug($slug);
        if(Auth()->user()){
            $wishList = Wishlist::where(['product_id' => $product_detail->id, 'user_id' => Auth()->user()->id])->first();
    
            // Initialize $inWishList
            $inWishList = ($wishList) ? true : false;
        
            return view('frontend.pages.product_detail')->with(['product_detail' => $product_detail, 'inWishList' => $inWishList]);    
        }
        return view('frontend.pages.product_detail')->with(['product_detail' => $product_detail, 'inWishList' => false]);
    }
    public function productLists(){
        $products=Product::query();
        
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids)->paginate;
            // return $products;
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            
            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(6);
        }
        // Sort by name , price, category

      
        return view('frontend.pages.product-lists')->with('products',$products)->with('recent_products',$recent_products);
    }
    public function productFilter(Request $request){
            $data= $request->all();
            // return $data;
            $showURL="";
            if(!empty($data['show'])){
                $showURL .='&show='.$data['show'];
            }

            $sortByURL='';
            if(!empty($data['sortBy'])){
                $sortByURL .='&sortBy='.$data['sortBy'];
            }

            $catURL="";
            if(!empty($data['category'])){
                foreach($data['category'] as $category){
                    if(empty($catURL)){
                        $catURL .='&category='.$category;
                    }
                    else{
                        $catURL .=','.$category;
                    }
                }
            }

            $brandURL="";
            if(!empty($data['brand'])){
                foreach($data['brand'] as $brand){
                    if(empty($brandURL)){
                        $brandURL .='&brand='.$brand;
                    }
                    else{
                        $brandURL .=','.$brand;
                    }
                }
            }
            // return $brandURL;

            $priceRangeURL="";
            if(!empty($data['price_range'])){
                $priceRangeURL .='&price='.$data['price_range'];
            }
            if(request()->is('e-shop.loc/product-grids')){
                return redirect()->route('product-grids',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
            }
            else{
                return redirect()->route('product-lists',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
            }
    }
    public function productBrand(Request $request){
        $products=Brand::getProductByBrand($request->slug);
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
        }

    }
    public function productCat(Request $request){
        $products=Category::getProductByCat($request->slug);
        // return $request->slug;
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
        }

    }
    public function productSubCat(Request $request){
        $products=Category::getProductBySubCat($request->sub_slug);
        // return $products;
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        }

    }

    public function blog(){
        $post=Post::query();
        
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=PostCategory::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            return $cat_ids;
            $post->whereIn('post_cat_id',$cat_ids);
            // return $post;
        }
        if(!empty($_GET['tag'])){
            $slug=explode(',',$_GET['tag']);
            // dd($slug);
            $tag_ids=PostTag::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // return $tag_ids;
            $post->where('post_tag_id',$tag_ids);
            // return $post;
        }

        if(!empty($_GET['show'])){
            $post=$post->where('status','active')->orderBy('id','DESC')->paginate($_GET['show']);
        }
        else{
            $post=$post->where('status','active')->orderBy('id','DESC')->paginate(9);
        }
        // $post=Post::where('status','active')->paginate(8);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    }

    public function blogDetail($slug){
        $post=Post::getPostBySlug($slug);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // return $post;
        return view('frontend.pages.blog-detail')->with('post',$post)->with('recent_posts',$rcnt_post);
    }
    public function blogSearch(Request $request){
        // return $request->all();
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $posts=Post::orwhere('title','like','%'.$request->search.'%')
            ->orwhere('quote','like','%'.$request->search.'%')
            ->orwhere('summary','like','%'.$request->search.'%')
            ->orwhere('description','like','%'.$request->search.'%')
            ->orwhere('slug','like','%'.$request->search.'%')
            ->orderBy('id','DESC')
            ->paginate(8);
        return view('frontend.pages.blog')->with('posts',$posts)->with('recent_posts',$rcnt_post);
    }
    public function blogFilter(Request $request){
        $data=$request->all();
        // return $data;
        $catURL="";
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catURL)){
                    $catURL .='&category='.$category;
                }
                else{
                    $catURL .=','.$category;
                }
            }
        }

        $tagURL="";
        if(!empty($data['tag'])){
            foreach($data['tag'] as $tag){
                if(empty($tagURL)){
                    $tagURL .='&tag='.$tag;
                }
                else{
                    $tagURL .=','.$tag;
                }
            }
        }
        // return $tagURL;
            // return $catURL;
        return redirect()->route('blog',$catURL.$tagURL);
    }

    public function blogByCategory(Request $request){
        $post=PostCategory::getBlogByCategory($request->slug);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post->post)->with('recent_posts',$rcnt_post);
    }
    public function blogByTag(Request $request){
        // dd($request->slug);
        $post=Post::getBlogByTag($request->slug);
        // return $post;
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    }
    public function login(){
        return view('frontend.pages.login');
    }
    public function loginSubmit(Request $request){
        $data= $request->all();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'status'=>'active'])){
            Session::put('user',$data['email']);
            request()->session()->flash('success','Successfully login');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Invalid email and password pleas try again!');
            return redirect()->back();
        }
    }
    public function logout(){
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success','Logout successfully');
        return back();
    }

    public function register(){
        return view('frontend.pages.register');
    }
    public function registerSubmit(Request $request){
        // return $request->all();
        $this->validate($request,[
            'name'=>'string|required|min:2',
            'email'=>'string|required|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);
        $data=$request->all();
        // dd($data);
        $check=$this->create($data);
        Session::put('user',$data['email']);
        if($check){
            request()->session()->flash('success','Successfully registered');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Please try again!');
            return back();
        }
    }
    public function create(array $data){
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'status'=>'active'
            ]);
    }
    // Reset password
    public function showResetForm(){
        return view('auth.passwords.old-reset');
    }

    public function subscribe(Request $request){
        if(! Newsletter::isSubscribed($request->email)){
                Newsletter::subscribePending($request->email);
                if(Newsletter::lastActionSucceeded()){
                    request()->session()->flash('success','Subscribed! Please check your email');
                    return redirect()->route('home');
                }
                else{
                    Newsletter::getLastError();
                    return back()->with('error','Something went wrong! please try again');
                }
            }
            else{
                request()->session()->flash('error','Already Subscribed');
                return back();
            }
    }
    
}
