<?php

namespace App\Models\Traits\Relations;

use App\Models\Conference\AgendaSlot;
use App\Models\Conference\Meeting;
use App\Models\User\Client;

trait ConferenceRelations
{
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'conference_clients', 'conference_id', 'client_id')
            ->withPivot('id', 'client_id', 'status', 'business_acceptance', 'business_acceptance_reason', 'invitation_code')
            ->withTimestamps();
    }

    public function slots()
    {
        return $this->hasMany(AgendaSlot::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class, 'conference_id');
    }
}
