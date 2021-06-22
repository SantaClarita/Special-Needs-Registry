<?php

namespace App;

use App\Participant;
use App\Role;
use App\Permissions;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
                'users.fname' => 10,
                'users.lname' => 10,
                'users.email' => 10,
                'users.phone' => 5,
                'roles.name' => 10,
            ],
            'joins' => [
                'role_user' => ['users.id', 'role_user.user_id'],
                'roles' => ['role_user.role_id','roles.id'],
            ],
    ];

    protected $fillable = [
        'fname', 'lname', 'email', 'password', 'phone',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    //GETTERS
    public function getPhoneAttribute($value)
    {   
        if ( is_numeric($value)){
            return '('.substr($value, 0, 3).') '.substr($value, 3, 3).'-'.substr($value, 6, 4);
        }
        else
            return $value;
    }

    //SETTERS
    public function setPhoneAttribute($value)
    {   
        $this->attributes['phone'] = preg_replace('/[^0-9]/','', $value);
    }

    public function participants() 
    { 
        return $this->hasMany(Participant::class); 
    } 

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function applications() 
    { 
        return $this->hasMany(Application::class); 
    } 

    public function viewLeftSidebar()
    {
        foreach ($this->roles()->get() as $role)
        {
            foreach ($role->permissions()->get() as $permission)
            {
                if ($permission->id == '1' || $permission->id == '8' || $permission->id == '9' || $permission->id == '10' || $permission->id == '3' )
                {
                    return true;
                }
            }
        }
    }
}
