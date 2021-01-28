<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //guarded: funciona como una lista negra
    protected $guarded = [];
}
