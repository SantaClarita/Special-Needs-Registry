<?php

namespace App\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class EmaillistPolicy
{
    use HandlesAuthorization;

    //'Add/Remove/Edit Email list Information'
    // MUST have Superuser, manage email list
    public function manageEmailList(User $user)
    {
        $collection = collect(new User);
        foreach ($user->roles as $role) {
            $collection = $role->permissions;
        }   
        $chk = false;
        foreach ($collection as $coll) {
            if ($coll->id === 1 || $coll->id === 10)
                $chk = true;
        }
        return $chk;
    }
}
