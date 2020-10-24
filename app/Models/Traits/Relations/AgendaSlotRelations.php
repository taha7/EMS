<?php

namespace App\Models\Traits\Relations;

use App\Models\Conference\Conference;
use App\Models\Conference\Meeting;

trait AgendaSlotRelations
{
    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class, 'agenda_slot_id');
    }
}
