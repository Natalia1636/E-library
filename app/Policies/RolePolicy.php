<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function delete(User $user, Role $role)
    {
        return $user->role === 'admin';
    }

    public function edit(User $user, Role $role)
    {
        return $user->role === 'admin' || $user->id;
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }
}
