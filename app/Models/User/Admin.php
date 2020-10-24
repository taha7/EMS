<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'activation', 'image', 'role_id', 'conference_id', 'signatory_profiles_id'
    ];
}
