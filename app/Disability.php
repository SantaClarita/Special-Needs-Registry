<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{
    public function participants()
    {
        return $this->belongsToMany('App\Participant');
    }
}
