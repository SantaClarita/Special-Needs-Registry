<?php

namespace App\Repositories;

use App\Disability;

class DisabilityRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function getAllDisabilities()
    {
        return Disability::all();
    }
}

