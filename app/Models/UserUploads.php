<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserUploads extends Model
{
    protected $table="user_uploads";

    protected $fillable=['id','user_id','url'];

}
