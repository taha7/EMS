<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class ClientType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'activation', 'type'];
}
