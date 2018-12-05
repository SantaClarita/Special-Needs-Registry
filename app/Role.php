<?php

namespace App;

use App\User;
use App\Permission;
use App\Emaillist;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name','description',
    ];
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function useremails()
    {
        return $this->belongsToMany('App\User')->select(['email']);
    }
    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }
    public function emaillists()
    {
        return $this->belongsToMany('App\Emaillist');
    }
}
