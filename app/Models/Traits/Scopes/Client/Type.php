<?php

namespace App\Models\Traits\Scopes\Client;

trait Type
{
    public function scopeInvestors($query)
    {
        return $query->whereHas('clientType', function ($q) {
            $q->investors();
        });
    }
}
