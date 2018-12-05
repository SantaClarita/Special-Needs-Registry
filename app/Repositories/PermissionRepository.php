<?php

namespace App\Repositories;

use App\User;
use App\Permission;
use App\Role;

class PermissionRepository
{
    public function getAllPermissions()
    {
        return Permission::all();
    }

    public function getRolePermissions(Role $role)
    {
        return Permission::find($role->id);
    }
}

