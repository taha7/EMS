<?php

namespace App\Models\Traits\Relations;

use App\Models\Conference\Meeting;
use App\Models\User\Client;

trait ConferenceClientRelations
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class, 'client_id', 'id');
    }
}
