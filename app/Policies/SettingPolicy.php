<?php

namespace App\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    //'Add/Remove/Edit Setting Information'
    // MUST have Superuser, manage email settings list
    public function manageSetting(User $user)
    {
        $collection = collect(new User);
        foreach ($user->roles as $role) {
            $collection = $role->permissions;
        }   
        $chk = false;
        foreach ($collection as $coll) {
            if ($coll->id === 1 || $coll->id === 11)
                $chk = true;
        }
        return $chk;
    }
}
