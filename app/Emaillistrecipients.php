<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emaillistrecipients extends Model
{
    protected $fillable = [
        'email','emaillist_id',
    ];

    public function emaillists()
    {
        return $this->belongsTo('App\Emaillists');
    }

}
