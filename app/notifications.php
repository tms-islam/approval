<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notifications extends Model
{
    //
    protected $fillable = [
        'userid', 'projectid', 'url','content','is_view'
    ];
}
