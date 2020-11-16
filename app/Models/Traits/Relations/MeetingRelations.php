<?php

namespace App\Models\Traits\Relations;

use App\Models\Conference\AgendaSlot;
use App\Models\Lookups\Company;
use App\Models\User\ConferenceClient;

trait MeetingRelations
{
    public function agendaSlot()
    {
        return $this->belongsTo(AgendaSlot::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function conferenceClient()
    {
        return $this->belongsTo(ConferenceClient::class, 'client_id');
    }
}
