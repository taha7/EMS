<?php

namespace App\Models\User;

use App\Models\Traits\Scopes\ClientType\Type;
use Illuminate\Database\Eloquent\Model;

class ClientType extends Model
{

    use Type;

    const INVESTORS = 1;
    const PRESENTERS = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'activation', 'type'];
}
