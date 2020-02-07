<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeCampus extends Model
{
    public function campus()
    {
        return $this->hasMany('App\Campus');
    }
}
