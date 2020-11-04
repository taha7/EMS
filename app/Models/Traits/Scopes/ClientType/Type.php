<?php

namespace App\Models\Traits\Scopes\ClientType;

trait Type
{
    public function scopeInvestors($query)
    {
        return $query->where('type', self::INVESTORS);
    }
}
