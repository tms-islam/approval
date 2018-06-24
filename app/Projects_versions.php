<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects_versions extends Model
{
    //
      protected $fillable = [
        'projectid', 'userid', 'version','comment','fileurl'
    ];
}
