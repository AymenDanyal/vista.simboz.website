<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Filter extends Model
{   
    protected $table = 'filter';
    public $timestamps = false;
    protected $primaryKey = 'filter_id';
    protected $fillable=['filter_name','filter_id'];

    public function parameters()
    {
        return $this->hasMany(FilterParameter::class, 'filter_id', 'filter_id');
    }

    public function values()
    {
        return $this->hasMany(FilterValue::class, 'filter_id');
    }


    public function filterCategory()
    {
        return $this->hasMany(FilterCategory::class, 'filter_id', 'filter_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'filter_category', 'filter_id', 'cat_id');
    }
    public static function groupParametersByFilterName(Collection $filters)
    {
        $groupedParameters = [];

        foreach ($filters as $filter) {
            $groupName = $filter->filter_id;

            if (!isset($groupedParameters[$groupName])) {
                $groupedParameters[$groupName] = [
                    'parameters' => [],
                    'categories' => [],
                ];
            }

            foreach ($filter->parameters as $parameter) {
                $groupedParameters[$groupName]['parameters'][] = $parameter;
            }

            foreach ($filter->categories as $category) {
                $groupedParameters[$groupName]['categories'][] = $category->title; // Assuming 'title' is the column name in the Category table
            }

            $groupedParameters[$groupName]['filter_id'] = $filter->filter_id;
            $groupedParameters[$groupName]['filter_name'] = $filter->filter_name;
            $groupedParameters[$groupName]['filter_cat'] = $filter->filter_cat;
        }

        return $groupedParameters;
    }

    
}
