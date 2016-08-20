<?php

namespace App\Repositories;

use App\User;

class GroupRepository
{
    /**
     * Get all of the groups for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->groups()
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}