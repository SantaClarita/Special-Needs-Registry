<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    public function forUser(User $user)
    {
        return User::find($user->id);
    }

    public function getEmailList()
    {
        return User::select('email', 'id')
                ->orderby('email')
                ->get();
    }

    public function search($search)
    {
        if ($search != '') //to fix for a non-existant 'relevance' column when search is ran with no terms relevance is generated when there are terms
            return User::with('roles')->search($search, null, true)->orderBy('relevance','desc')->orderBy('lname')->orderBy('fname')->paginate(50);
        else 
            return User::with('roles')->search($search, null, true)->paginate(50);

    }

    public function searchWithDeleted($search)
    {
        if ($search != '') //to fix for a non-existant 'relevance' column when search is ran with no terms relevance is generated when there are terms
            return User::withTrashed()
                            ->with('roles')
                            ->search($search, null, true)
                            ->orderBy('relevance','desc')
                            ->orderBy('lname')
                            ->orderBy('fname')
                            ->paginate(50);
        else 
            return User::withTrashed()
                            ->with('roles')
                            ->search($search, null, true)
                            ->paginate(50);

    }


}

