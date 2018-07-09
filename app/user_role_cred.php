<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_role_cred extends Model
{
    //

     protected $fillable = [
        'role_id',
        'role_type_id'
    ];
}
