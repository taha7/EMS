<?php

namespace App\Models\Lookups;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'activation', 'sector_id', 'country_id'];
}
