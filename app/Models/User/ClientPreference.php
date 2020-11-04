<?php

namespace App\Models\User;

use App\Models\Traits\Scopes\General\InConf;
use App\Models\Traits\Scopes\General\WithCompany;
use Illuminate\Database\Eloquent\Model;

class ClientPreference extends Model
{
    use InConf, WithCompany;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'conference_id', 'company_id', 'meeting_priority', 'shareholder', 'meeting_type', 'knowledge'
    ];
}
