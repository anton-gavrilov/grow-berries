<?php

namespace App\Policies\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

trait ViewModelPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Model $model)
    {
        return $user->can($this->getModelClass(). '_view');
    }
}
