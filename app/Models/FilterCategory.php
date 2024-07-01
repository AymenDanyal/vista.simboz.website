<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterCategory extends Model
{
    protected $table = 'filter_category';
    protected $fillable=['cat_id','filter_id'];
    protected $primaryKey = 'filter_id';
    
    public function Filter()
    {
        return $this->hasMany(Filter::class, 'filter_id', 'filter_id');
    }
    public function Category()
    {
        return $this->hasMany(Category::class, 'id', 'cat_id');
    }
}
