<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

abstract class ModelPolicy
{
    use HandlesAuthorization;
    
    protected function getModelClass(): string
    {
        return strtolower(str_replace('Policy', '', class_basename($this)));
    }
}
