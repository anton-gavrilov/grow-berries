<?php

namespace App\Policies\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

trait ForceDeleteModelPolicy
{
    /**
     * Determine whether the user can permanently delete the model.
     */
    public function delete(User $user, Model $model): bool
    {
        return $user->can($this->getModelClass(). '_forceDelete');
    }
}
