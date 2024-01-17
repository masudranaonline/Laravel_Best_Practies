<?php

namespace App\Policies;

use App\Models\User;
use App\Constans\Role;
use App\Models\Offer;

class OfferPolicy
{
    /**
     * Create a new policy instance.
     */


    public function create(User $user)
    {
        return true;
        return $user->role === 'user';
    }
}
