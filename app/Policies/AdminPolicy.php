<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    /**
     * Create a new policy instance.
     */
    use HandlesAuthorization;

    public function access(User $user)
    {
        return $user->role === 'admin';
    }
}
