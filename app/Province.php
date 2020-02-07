<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function departament()
    {
        return $this->belongsTo('App\Deparment');
    }
}
