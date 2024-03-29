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

     public function viewAny(User $user)
    {
        return $user->role === Role::ADMIN;
    }

    public function viewMy(User $user)
    {
        return $user->role === Role::USER;
    }

    public function create(User $user)
    {
        return $user->role === Role::USER;
    }

    public function update(User $user, Offer $offer)
    {
        return $user->role === Role::ADMIN || ($user->role === Role::USER && $user->id === $offer->author_id);
       
    }
}
