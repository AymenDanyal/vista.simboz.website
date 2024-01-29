<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTemplate extends Model
{
    protected $table="user_template";

    protected $fillable=['id','front','back'];

}
