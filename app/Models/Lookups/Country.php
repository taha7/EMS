<?php

namespace App\Models\Lookups;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'activation', 'iso', 'iso3', 'nicename', 'numcode', 'phonecode'];
}
