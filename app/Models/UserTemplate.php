<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTemplate extends Model
{
    protected $table="user_template";

    protected $fillable=['id','front','back','front_psd_url','back_psd_url','template_height','	template_width','product_id','user_id','title'];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
