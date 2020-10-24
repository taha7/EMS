<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class ClientPreference extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'conference_id', 'company_id', 'meeting_priority', 'shareholder', 'meeting_type', 'knowledge'
    ];
}
