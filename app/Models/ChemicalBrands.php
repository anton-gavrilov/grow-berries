<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChemicalBrands extends Model
{
    public $timestamps = false;
    protected $fillable = ['country', 'name', 'about'];


}
