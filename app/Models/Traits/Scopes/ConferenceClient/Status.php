<?php

namespace App\Models\Traits\Scopes\ConferenceClient;

trait Status
{
    public function scopeRegistered($query)
    {
        return $query->where('status', self::REGISTERED);
    }
}
