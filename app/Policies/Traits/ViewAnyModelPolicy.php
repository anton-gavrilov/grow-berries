<?php

namespace App\Policies\Traits;

use App\Models\User;

trait ViewAnyModelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can( $this->getModelClass(). '_viewAny');
    }
}
