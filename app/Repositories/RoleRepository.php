<?php

namespace App\Repositories;

use App\User;
use App\Role;
use App\Emaillist;

class RoleRepository
{
    public function getAllRoles()
    {
        return Role::all();
    }

    public function getRolesWithPermissions()
    {
        return Role::with('permissions')->orderBy('name')->get();
    }

    public function forRole(Role $role)
    {
        return Role::find($role->id);
    }

    public function forUser(User $user)
    {
        return User::find($user->id);
    }
}

