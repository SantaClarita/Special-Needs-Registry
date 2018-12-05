<?php

namespace App\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class LogPolicy
{
    use HandlesAuthorization;

    //'Add/Remove/Edit Dependent Information'
    // MUST have Superuser, manage roles/permissions list
    public function viewLogs(User $user)
    {
        $collection = collect(new User);
        foreach ($user->roles as $role) {
            $collection = $role->permissions;
        }   
        $chk = false;
        foreach ($collection as $coll) {
            if ($coll->id === 1 || $coll->id === 12)
                $chk = true;
        }
        return $chk;
    }
}
