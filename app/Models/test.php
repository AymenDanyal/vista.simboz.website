<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
class Product extends Model
{
    protected $fillable=['title','slug','summary','description','cat_id','child_cat_id','price','brand_id','discount','status','photo','size','stock','is_featured','condition'];

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
    public static function getProductBySlug($slug){
        return Product::with(['cat_info','rel_prods','getReview'])->where('slug',$slug)->first();
    }
    public static function countActiveProduct(){
        $data=Product::where('status','active')->count();
        if($data){
            return $data;
        }
        return 0;
    }

    public function carts(){
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }

    public function brand(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }






    


    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function filters()
    {
        return $this->hasManyThrough(
            Filter::class,
            FilterValue::class,
            'product_id', // Foreign key on FilterValue table
            'filter_id',  // Foreign key on Filter table
            'id',         // Local key on Products table
            'filter_id'   // Local key on FilterValue table
        );
    }
    public function getProductDetails()
    {
        // Get category
        $category = ($this->category)->toArray();

        // Get filters associated with this product
        $filters = $this->filters()->with('parameters')->get()->toArray();

        // Get filter values
        $filterValues = $this->filterValues()->with('filter')->get()->toArray();
        $product=($this)->toArray();
        // Combine the data into a structured array
        $details = [
            'product' => $product,
            'category' => $category,
            'filters' => $filters,
            'filter_values' => $filterValues,
        ];

        return $details;
    }
    public function filterValues()
    {
        return $this->hasMany(FilterValue::class, 'product_id', 'id');
    }
    public function template()
    {
        return $this->belongsTo(Template::class, 'product_id');
    }

}
