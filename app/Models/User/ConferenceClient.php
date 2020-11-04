<?php

namespace App\Models\User;

use App\Models\Traits\Relations\ConferenceClientRelations;
use App\Models\Traits\Scopes\ConferenceClient\Status;
use App\Models\Traits\Scopes\General\InConf;
use Illuminate\Database\Eloquent\Model;

class ConferenceClient extends Model
{
    use InConf, Status, ConferenceClientRelations;

    const REGISTERED = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'conference_id', 'client_id', 'status', 'business_acceptance', 'business_acceptance_reason', 'invitation_code',
        'complete_survey', 'arrival_date', 'arrival_time', 'departure_date', 'departure_time', 'remarks', 'available_slot',
        'is_disable', 'disable_reason', 'prefer_interview', 'registration_date'
    ];
}
