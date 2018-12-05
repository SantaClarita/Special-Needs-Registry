<?php

namespace App\Policies;

use App\User;
use App\Participant;

use Illuminate\Auth\Access\HandlesAuthorization;

class ParticipantPolicy
{
    use HandlesAuthorization;

    //'Add/Remove/Edit Participant Information'
    // MUST have Superuser, manage participant list permission, or be owner
    public function manageParticipantList(User $user, Participant $participant)
    {
        $collection = collect(new User);
        foreach ($user->roles as $role) {
            $collection = $role->permissions;
        }   
        $chk = false;
        foreach ($collection as $coll) {
            if ($coll->id === 1 || $coll->id === 2)
                $chk = true;
        }
        return $chk || $user->id === $participant->user_id;
    }

    //This policy is meant for non owner commands such as transfer ownership
    public function manageParticipantListAboveOwner(User $user, Participant $participant)
    {
        $collection = collect(new User);
        foreach ($user->roles as $role) {
            $collection = $role->permissions;
        }   
        $chk = false;
        foreach ($collection as $coll) {
            if ($coll->id === 1 || $coll->id === 2)
                $chk = true;
        }
        return $chk;
    }

    public function manageParticipantNoEmailList(User $user, Participant $participant)
    {
        $collection = collect(new User);
        foreach ($user->roles as $role) {
            $collection = $role->permissions;
        }   
        $chk = false;
        foreach ($collection as $coll) {
            if ($coll->id === 1 || $coll->id === 2)
                $chk = true;
        }
        return $chk;
    }

    // MUST have Superuser, view participant profile permission, view all participant profiles, or be owner
    public function viewParticipantProfile(User $user, Participant $participant)
    {
        $collection = collect(new User);
        foreach ($user->roles as $role) {
            $collection = $role->permissions;
        }   
        $chk = false;
        foreach ($collection as $coll) {
            if ($coll->id === 1 || $coll->id === 4)
                $chk = true;
        }
        return $user->id === $participant->user_id || $chk;
    }

    // MUST have Superuser, view participant flyer permission, view all participant flyers, or be owner
    public function viewParticipantFlyer(User $user, Participant $participant)
    {
        $collection = collect(new User);
        foreach ($user->roles as $role) {
            $collection = $role->permissions;
        }   
        $chk = false;
        foreach ($collection as $coll) {
            if ($coll->id === 1 || $coll->id === 5)
                $chk = true;
        }
        return $chk;
    }

    // MUST have Superuser, view all participant flyers
    public function emailParticipantFlyer(User $user, Participant $participant)
    {
        $collection = collect(new User);
        foreach ($user->roles as $role) {
            $collection = $role->permissions;
        }   
        $chk = false;
        foreach ($collection as $coll) {
            if ($coll->id === 1 || $coll->id === 7)
                $chk = true;
        }
        return $chk;
    }

    // MUST have Superuser, view all participant ID permission
    public function viewParticipantIDs(User $user, Participant $participant)
    {
        if($participant->user_id == $user->id)
            return true;
        $collection = collect(new User);
        foreach ($user->roles as $role) {
            $collection = $role->permissions;
        }   
        $chk = false;
        foreach ($collection as $coll) {
            if ($coll->id === 1 || $coll->id === 6)
                $chk = true;
        }
        return $chk;
    }

    //Must be superuser, or can preform search
    public function CanSearchParticipants(User $user)
    {
        $collection = collect(new User);
        foreach ($user->roles as $role) {
            $collection = $role->permissions;
        }   
        $chk = false;
        foreach ($collection as $coll) {
            if ($coll->id === 1 || $coll->id === 3)
                $chk = true;
        }
        return $chk;
    }
}
