<?php

namespace App\Models\Traits\Relations;

use App\Models\Conference\Meeting;
use App\Models\User\Client;

trait CompanyRelations
{
    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
