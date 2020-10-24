<?php

namespace App\Repositories\Eloquent;

use App\Models\ConferenceClient as CC;

class InvestorRepo
{
    public function paginate()
    {

        CC::inConf()
            ->registered()
            ->whereHas('clients', function ($clients) {
                $clients->investors();
            })
            ->with(['client' => function ($clients) {
                $clients->with([
                    'client_preferences' => function ($preferences) {
                        $preferences->inConf()->prefCompany(request('company_id'));
                    },
                    'company',
                    'client_type',
                    'company',
                    'country',
                    'title',
                    'primary_signatory'
                ]);
            }]);
    }
}
