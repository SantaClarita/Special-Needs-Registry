<?php

namespace App;
use App\Role;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = [
        'user_id','role_id',
    ];
}
