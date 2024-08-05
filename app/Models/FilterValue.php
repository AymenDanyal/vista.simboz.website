<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterValue extends Model
{   
    protected $primaryKey = 'filter_id';
    protected $table = 'filter_value';
    protected $fillable=['filter_value_id','filter_value','filter_id','product_id' ,'param_id'];
    
    public function parameters()
{
    return $this->hasMany(FilterParameter::class, 'filter_id'); // Replace 'column_name' with the actual column name you want to group by
}

    public function values()
    {
        return $this->hasMany(FilterValue::class, 'filter_id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function filter()
    {
        return $this->belongsTo(Filter::class, 'filter_id', 'filter_id');
    }
    
}
