<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    //
    
        protected $fillable = ['userid', 'projectid', 'is_delete','comment','content'];

}
