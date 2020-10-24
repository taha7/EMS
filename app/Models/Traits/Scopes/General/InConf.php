<?php

namespace App\Models\Scopes\General;

use Illuminate\Database\Eloquent\Builder;

trait InConf
{
    public function scopeInConf(Builder $query, $confId = 37)
    {
        return $query->where('conference_id', $confId);
    }
}
