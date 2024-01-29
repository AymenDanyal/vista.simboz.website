<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateApi extends Model
{
    protected $table="template";

    protected $fillable=['id','front','back','product_id',
    'front',
    'template_height',
    'template_width'];

}
