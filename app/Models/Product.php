<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
class Product extends Model
{
    protected $fillable=['title','slug','summary','description','cat_id','child_cat_id','price','brand_id','discount','status','photo','size','stock','is_featured','condition'];

    public function wishlists(){
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }
    public function brand(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }
    public function carts(){
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function getProductDetails()
    {
        $product=($this)->toArray();
        $category = ($this->category)->get()->toArray();
        
        $filterValues = $this->filterValues()->get()->toArray();
        $template = $this->template()->get()->toArray();
        
        $details = [
            'product' => $product,
            'category' => $category,
            'template' => $template,
            'filter_values' => $filterValues,
        ];

        return $details;
    }
    public function priceRange(){
        return $this->hasMany(PriceRange::class)->whereNotNull('product_id');
    }

    //product detail page
    public function getProductDetailsWithParam($id)
    {
        $product_detail = self::find($id);
        if (!$product_detail) {
            return null;
        }
        

        $reviews = ProductReview::where('product_id', $id)->get();
        $reviewCount = $reviews->count();
        $averageRating = number_format(($reviewCount > 0 ? $reviews->avg('rate') : 0), 1);

        
        $product_filters = FilterValue::where('product_id', $id)->get();
        $param_ids = $product_filters->pluck('param_id')->unique();
        

        $product_param = FilterParameter::whereIn('param_id', $param_ids)->with('filter')->get();
        $filtersWithParameters = [];

        foreach ($product_param as $param) {
            $param_id = $param->param_id;
            $filterName = $param->filter->filter_name;
            $paramValue = $param->param_value;
            $paramPrice = $param->param_price;
        
            if (!isset($filtersWithParameters[$filterName])) {
                $filtersWithParameters[$filterName] = [];
            }
        
            // Store both the parameter value and its price as an associative array
            $filtersWithParameters[$filterName][] = [
                'value' => $paramValue,
                'price' => $paramPrice,
                'param_id' => $param_id,
            ];
        }
        $reviewData = [
            'review_count' => $reviewCount,
            'average_rating' => number_format($averageRating, 1), // Format to 1 decimal place if needed
        ];

        return [
            'product_detail' => $product_detail,
            'product_param' => $filtersWithParameters,
            'reviews'=>$reviewData,
            'priceRange'=>$this->priceRange,
            'count_priceRange'=>($this->priceRange)->count(),
        ];
    }
    public function filterValues()
    {
        return $this->hasMany(FilterValue::class, 'product_id', 'id');
    }
    public function template()
    {   
        return $this->hasOne (Template::class, 'product_id');
    }















    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    public function sub_cat_info(){
        return $this->hasOne('App\Models\Category','id','child_cat_id');
    }
    public static function getAllProduct(){
        return Product::with(['cat_info','sub_cat_info'])->orderBy('id','desc')->paginate(10);
    }
    public function rel_prods(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->orderBy('id','DESC')->limit(8);
    }
    public function getReview(){
        return $this->hasMany('App\Models\ProductReview','product_id','id')->with('user_info')->where('status','active')->orderBy('id','DESC');
    }
    public static function getProductById($id){
        return Product::with(['cat_info'])->where('id',$id)->first();
    }
    public static function countActiveProduct(){
        $data=Product::where('status','active')->count();
        if($data){
            return $data;
        }
        return 0;
    }

}
