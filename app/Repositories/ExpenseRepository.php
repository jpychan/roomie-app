<?php

namespace App\Repositories;

use App\User;

class ExpenseRepository
{
    /**
     * Get all of the expenses for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->expenses()
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    public function forGroup(Group $group)
    {
        return $group->expenses()
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}