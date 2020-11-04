<?php

namespace App\Models\Traits\Scopes\General;

trait WithCompany
{
    public function scopeWithCompany($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }
}
