<?php

namespace App\Policies;

use App\User;
use App\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given group.
     *
     * @param  User  $user
     * @param  Group  $group
     * @return bool
     */
    public function destroy(User $user, Group $group)
    {
        return $user->id === $group->user_id;
    }

    public function edit(User $user, Group $group)
    {
        return $user->id === $group->user_id;
    }

    public function manageMembers(User $user, Group $group)
    {
        return $user->id === $group->user_id;
    }

    public function show(User $user, Group $group)
    {
        return $group->users->contains($user);
    }


}