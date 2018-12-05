<?php

namespace App\Repositories;

use App\Emaillist;
use App\Role;

class EmaillistRepository
{   
    public function getAllEmaillists()
    {
        return Emaillist::all();
    }

    public function getEmaillistsWithRoleEmailRecipient()
    {
        return Emaillist::with('roles', 'useremails')
                        ->get();
    }

    public function forEmaillist(Emaillist $emaillist)
    {
        return Emaillist::find($emaillist->id);
    }
    public function getEmaillistByName($name)
    {
        return Emaillist::where('name', $name)->first();
    }

    public function getEmailsWithCurrentRoles(Emaillist $emaillist)
    {
        $getroles = Emaillist::with('roles')->find($emaillist->id);
        $getuseremailsforroles = array();
        foreach ($getroles->roles as $i => $role) {
            foreach ($role->users as $j => $user) {
                array_push($getuseremailsforroles, $user->email);                
            }
        }
        return $getuseremailsforroles;
    }

    public function getCurrentEmails($id)
    {
        $emaillists = Emaillist::with('roles','useremails')->find($id);
        $getuseremailsforrolesandrecipients = array();
        foreach ($emaillists->roles as $i => $role) {
            foreach ($role->users as $j => $user) {
                array_push($getuseremailsforrolesandrecipients, $user->email);                
            }
        }
        foreach ($emaillists->useremails as $i => $user) {
            array_push($getuseremailsforrolesandrecipients, $user->email);                
        }

        if (empty($getuseremailsforrolesandrecipients))
            abort(202, 'The email list is empty. This is because the current email list tied to this action has no email recipients.');
        
        return $getuseremailsforrolesandrecipients;
    }

    public function getEmailsWithRole($id)
    {
        return Role::with('useremails')->find($id)->useremails;
    }
}

