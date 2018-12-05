<?php

namespace App;

use App\Emaillistrecipients;

use Illuminate\Database\Eloquent\Model;

class Emaillist extends Model
{
    protected $fillable = [
        'name','description',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    public function settings()
    {
        return $this->belongsToMany('App\Setting');
    }
    public function useremails()
    {
        return $this->hasMany('App\Emaillistrecipients');
    }
}
