<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name','description',
    ];

    public function emaillists()
    {
        return $this->belongsToMany('App\Emaillist');
    }


}
