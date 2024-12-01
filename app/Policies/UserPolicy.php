<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function edit(User $currentUser, User $user)
    {
        return $currentUser->isAdmin() || $currentUser->id === $user->id;
    }

    public function delete(User $currentUser, User $user)
    {
        return $currentUser->isAdmin() || $currentUser->id !== $user->id;
    }
}
