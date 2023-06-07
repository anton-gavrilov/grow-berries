<?php

namespace App\Policies\Traits;

use App\Models\User;

trait CreateModelPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can($this->getModelClass(). '_create');
    }
}
