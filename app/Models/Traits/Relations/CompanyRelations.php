<?php

namespace App\Models\Traits\Relations;

use App\Models\Conference\Meeting;

trait CompanyRelations
{
    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
}
