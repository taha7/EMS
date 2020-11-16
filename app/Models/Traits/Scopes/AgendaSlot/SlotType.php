<?php

namespace App\Models\Traits\Scopes\AgendaSlot;

trait SlotType
{
    public function scopePrivateAndException($query)
    {
        return $query->whereIn('type', [self::PRIVATE_SLOT, self::EXCEPTION_SLOT]);
    }
}
