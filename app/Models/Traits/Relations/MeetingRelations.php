<?php

namespace App\Models\Traits\Relations;

use App\Models\Conference\AgendaSlot;
use App\Models\Lookups\Company;

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
}
