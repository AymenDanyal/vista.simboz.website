<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table="template";

    protected $fillable=['id','front','back','product_id',
    'front',
    'template_height',
    'template_width'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
