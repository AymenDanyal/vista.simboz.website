<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\TemplateApi;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::getAllProduct();
        // return $products;
        return view('backend.product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  /*   public function create()
    {
    
        $brand=Brand::get();
        $category=Category::where('is_parent',1)->get();
        // return $category;
        return view('backend.product.create')->with('categories',$category)->with('brands',$brand);
    } */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //dd($request->all());
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'size'=>'nullable',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'brand_id'=>'nullable|exists:brands,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'status'=>'required|in:active,inactive',
            'condition'=>'required|in:default,new,hot',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric',
            'template'=>'string',
            'template_width'=>'numeric',
            'template_height'=>'numeric',
        ]);
        
        $data=$request->all();
        // Remove the 'template' field from the data array
        
        $slug=Str::slug($request->title);
        $count=Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        $data['is_featured']=$request->input('is_featured',0);
        $size=$request->input('size');
        if($size){
            $data['size']=implode(',',$size);
        }
        else{
            $data['size']='';
        }
        // return $size;
        // return $data;
        $status=Product::create($data);
        $productId= $status->id;
        
        $template = $request->input('template');
        $template_height = $request->input('template_height');
        $template_width = $request->input('template_width');
      
        if($status){
            $status1= TemplateApi::create(['product_id' => $productId,
                                           'front'=>$template,
                                           'template_height'=>$template_height,
                                           'template_width'=>$template_width,
                                                                         
        ]);
        

            request()->session()->flash('success','Product Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /*  public function show($id)
    {
        //
    } */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $brand = Brand::get();
    $product = Product::findOrFail($id);
    $category = Category::where('is_parent', 1)->get();
    
    // Assuming TemplateApi returns a single object
    $template = TemplateApi::where('product_id' , $product->id)->first(); // Use first() to retrieve a single result
   
    $items = Product::where('id', $id)->get();

    return view('backend.product.edit')
        ->with('product', $product)
        ->with('brands', $brand)
        ->with('template', $template)
        ->with('categories', $category)
        ->with('items', $items);
}

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=Product::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'size'=>'nullable',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'brand_id'=>'nullable|exists:brands,id',
            'status'=>'required|in:active,inactive',
            'condition'=>'required|in:default,new,hot',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric',
            'template'=>'string',
            'template_width'=>'numeric',
            'template_height'=>'numeric',
        ]);

        $data=$request->all();
        $data['is_featured']=$request->input('is_featured',0);
        $size=$request->input('size');
        if($size){
            $data['size']=implode(',',$size);
        }
        else{
            $data['size']='';
        }
        // return $data;
        $status=$product->fill($data)->save();
        if($status){
            $template=TemplateApi::where(['product_id'=>$product->id,
                                          ])->first();
                                        
            $template->template_height= $request->input('template_height');
            $template->template_width= $request->input('template_width');
            $template->front=$request->input('template');
            $template->save();

            request()->session()->flash('success','Product Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {   
       
  
  
        $template = TemplateApi::where('product_id', $product_id)->first();
        $status1=$template->delete();

       
        $product=Product::findOrFail($product_id);
        $status=$product->delete();
      
        
        
        if($status){
            request()->session()->flash('success','Product successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting product');
        }
        return redirect()->route('product.index');
    }
}
