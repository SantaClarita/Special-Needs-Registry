<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ethnicity extends Model
{
    public function dependents()
    {
        return $this->belongsToMany('App\Dependent');
    }
}
