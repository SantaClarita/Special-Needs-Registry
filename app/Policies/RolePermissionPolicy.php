<?php

namespace App\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class RolePermissionPolicy
{
    use HandlesAuthorization;

    //'Add/Remove/Edit Role Information'
    // MUST have Superuser, manage roles/permissions list
    public function manageRolesList(User $user)
    {
        $collection = collect(new User);
        foreach ($user->roles as $role) {
            $collection = $role->permissions;
        }   
        $chk = false;
        foreach ($collection as $coll) {
            if ($coll->id === 1 || $coll->id === 8)
                $chk = true;
        }
        return $chk;
    }
}
