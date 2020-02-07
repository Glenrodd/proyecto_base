<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    public function type_campus()
    {
        return $this->belongsTo('App\TypeCampus');
    }

    public function deparment()
    {
        return $this->belongsTo('App\Deparment');
    }

    public function province()
    {
        return $this->belongsTo('App\Province');
    }
}
