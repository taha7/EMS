<?php

namespace App\Models\Traits\Relations;

use App\Models\Lookups\Company;
use App\Models\Lookups\Country;
use App\Models\Lookups\Signatory;
use App\Models\Lookups\Title;
use App\Models\User\ClientType;
use App\Models\User\ConferenceClient;

trait ClientRelations
{
    public function conferenceClients()
    {
        return $this->hasMany(ConferenceClient::class);
    }

    public function clientType()
    {
        return $this->belongsTo(ClientType::class)
            ->withDefault([
                'name' => '',
                'activation' => 0
            ]);
    }

    public function clientPreferences()
    {
        return $this->hasMany(ClientPreferences::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class)
            ->withDefault([
                'name' => '',
                'activation' => 0
            ]);
    }

    public function title()
    {
        return $this->belongsTo(Title::class)
            ->withDefault([
                'name' => '',
                'activation' => 0
            ]);
    }

    public function company()
    {
        return $this->belongsTo(Company::class)
            ->withDefault([
                'name' => '',
                'activation' => 0
            ]);
    }

    public function primarySignatory()
    {
        return $this->belongsTo(Signatory::class, 'primary_signatory_id')
            ->withDefault([
                'name' => '',
                'email' => ''
            ]);
    }

    public function secondarySignatory()
    {
        return $this->belongsTo(Signatory::class, 'secondary_signatory_id')
            ->withDefault([
                'name' => '',
                'email' => ''
            ]);
    }
}
