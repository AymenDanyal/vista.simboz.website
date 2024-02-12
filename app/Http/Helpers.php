<?php
use App\Models\Message;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Shipping;
use App\Models\Cart;
// use Auth;
class Helper{
    public static function messageList()
    {
        return Message::whereNull('read_at')->orderBy('created_at', 'desc')->get();
    } 
    public static function getAllCategory(){
        $category=new Category();
        $menu=$category->getAllParentWithChild();
        return $menu;
    } 
    
    public static function getHeaderCategory()
    {
        $category = new Category();
        $menu = $category->getAllParentWithChild();
    
        if ($menu) {
            echo '<li class="drop">';
            echo '<a href="javascript:void(0)">Categories  <i class="fa fa-angle-down" aria-hidden="true"></i></a>';
            echo '<div class="mt-dropmenu text-left">';
            echo '<div class="mt-frame">';
            echo '<div class="mt-f-box">';
    
            foreach ($menu as $cat_info) {
                if ($cat_info->child_cat->count() > 0) {
                    echo '<div class="mt-col-3">';
                    echo '<div class="sub-dropcont">';
                    echo '<strong class="title"><a href="' . route('product-cat', $cat_info->slug) . '" class="mt-subopener">Shop Pages</a></strong>';
                    echo '<div class="sub-drop"><ul>';
    
                    foreach ($cat_info->child_cat as $sub_menu) {
                        echo '<li><a href="' . route('product-sub-cat', [$cat_info->slug, $sub_menu->slug]) . '">' . $sub_menu->title . '</a></li>';
                    }
    
                    echo '</ul></div></div></div>';
    
                    // Add promo banner every 3rd category
                    if ($cat_info->child_cat->count() % 3 == 0) {
                        echo '<div class="mt-col-3 promo">';
                        echo '<div class="mt-promobox">';
                        echo '<a href="#"><img src="images/banner-drop.jpg" alt="promo banner" class="img-responsive"></a>';
                        echo '</div></div>';
                    }
                }
            }
    
            echo '</div></div></div><span class="mt-mdropover"></span></li>';
        }
    }
    

    public static function productCategoryList($option='all'){
        if($option='all'){
            return Category::orderBy('id','DESC')->get();
        }
        return Category::has('products')->orderBy('id','DESC')->get();
    }

    public static function postTagList($option='all'){
        if($option='all'){
            return PostTag::orderBy('id','desc')->get();
        }
        return PostTag::has('posts')->orderBy('id','desc')->get();
    }

    public static function postCategoryList($option="all"){
        if($option='all'){
            return PostCategory::orderBy('id','DESC')->get();
        }
        return PostCategory::has('posts')->orderBy('id','DESC')->get();
    }
    // Cart Count
    public static function cartCount($user_id=''){
       
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Cart::where('user_id',$user_id)->where('order_id',null)->sum('quantity');
        }
        else{
            return 0;
        }
    }
    // relationship cart with product
    public function product(){
        return $this->hasOne('App\Models\Product','id','product_id');
    }

    public static function getAllProductFromCart($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            
            return Cart::with('product')->where('user_id',$user_id)->where('order_id',null)->get();
        }
        else{
            return 0;
        }
    }
    // Total amount cart
    public static function totalCartPrice($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Cart::where('user_id',$user_id)->where('order_id',null)->sum('amount');
        }
        else{
            return 0;
        }
    }
    // Wishlist Count
    public static function wishlistCount($user_id=''){
       
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Wishlist::where('user_id',$user_id)->where('cart_id',null)->sum('quantity');
        }
        else{
            return 0;
        }
    }
    
    
    public static function getAllProductFromWishlist($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == '') {
                $user_id = auth()->user()->id;
            }
            return Wishlist::with('product')->where('user_id', $user_id)->where('cart_id', null)->get();
        } else {
            // Return an empty array if the user is not authenticated
            return [];
        }
    }
    
    public static function totalWishlistPrice($user_id=''){
        if(Auth::check()){
            if($user_id=="") $user_id=auth()->user()->id;
            return Wishlist::where('user_id',$user_id)->where('cart_id',null)->sum('amount');
        }
        else{
            return 0;
        }
    }

    // Total price with shipping and coupon
    public static function grandPrice($id,$user_id){
        $order=Order::find($id);
        dd($id);
        if($order){
            $shipping_price=(float)$order->shipping->price;
            $order_price=self::orderPrice($id,$user_id);
            return number_format((float)($order_price+$shipping_price),2,'.','');
        }else{
            return 0;
        }
    }


    // Admin home
    public static function earningPerMonth(){
        $month_data=Order::where('status','delivered')->get();
        // return $month_data;
        $price=0;
        foreach($month_data as $data){
            $price = $data->cart_info->sum('price');
        }
        return number_format((float)($price),2,'.','');
    }

    public static function shipping(){
        return Shipping::orderBy('id','DESC')->get();
    }
}

?>