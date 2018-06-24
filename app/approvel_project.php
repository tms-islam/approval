<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class approvel_project extends Model
{
    //
     protected $fillable = [
        'title', 'desc', 'fileurl','uploadedUser','status','licensor'
    ];
}
