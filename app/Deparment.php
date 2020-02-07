<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deparment extends Model
{
    public function provinces()
    {
        return $this->hasMany('App\Province');
    }
}
