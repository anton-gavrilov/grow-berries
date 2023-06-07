<?php

namespace App\Http\Controllers;

abstract class ModelController extends Controller
{
    /** @var array 'method' => 'policy'*/
    protected $guardedMethods = [];
    
    protected $methodsWithoutModels = [];
    
    protected function getModelClass(): string {
        return 'App\Models\\' . ucfirst(str_replace('Controller', '', class_basename($this)));
    }
    
    public function __construct()
    {
        $this->authorizeResource($this->getModelClass());
    }
    
    protected function resourceAbilityMap()
    {
        $base = parent::resourceAbilityMap();
        
        return array_merge($base, $this->guardedMethods);
    }
    
    protected function resourceMethodsWithoutModels()
    {
        $base = parent::resourceMethodsWithoutModels();
        
        return array_merge($base, $this->methodsWithoutModels);
    }
}
