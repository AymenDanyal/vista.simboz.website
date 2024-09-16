<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartFilters extends Model
{
    use HasFactory;
    protected $fillable=['cart_id','parameter_id'];

    public function Cart(){
        return $this->belongsTo(Cart::class,'cart_id');
    }
    public function Parameters(){
        return $this->belongsTo(FilterParameter::class,'parameter_id');
    }
}
