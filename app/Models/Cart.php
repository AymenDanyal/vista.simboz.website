<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable=['user_id','product_id','order_id','quantity','amount','price','status'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
    public function cart_filters()
    {
        return $this->hasMany(CartFilters::class, 'cart_id', 'id');
    }
    public function cartTotal(){
        return $this->sum('amount');
    }
}
