<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceRange extends Model
{
    use HasFactory;
    protected $table="price_range";
    protected $fillable=['product_id','min_range','max_range','price'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
