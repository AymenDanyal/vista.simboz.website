<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterParameter extends Model
{
    protected $table = 'filter_parameter';
    protected $fillable=['filter_id','param_value','param_id'];
    protected $primaryKey = 'param_id';

    // Define the relationship with Filter
    public function filter()
    {
        return $this->belongsTo(Filter::class, 'filter_id');
    }

    public function values()
    {
        return $this->hasMany(FilterValue::class, 'param_id');
    }
}
