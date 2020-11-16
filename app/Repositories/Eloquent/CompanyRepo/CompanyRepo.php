<?php

namespace App\Repositories\Eloquent\CompanyRepo;

use App\Models\Lookups\Company;
use App\Repositories\Contracts\CompanyRepoContract;
use App\Repositories\Eloquent\ClientRepo\Appends\PresentersAppend;
use App\Repositories\Eloquent\EloquentRepoAbstract;
use App\Repositories\Eloquent\GlobalAppends\{EagerLoadAppend, InConfAppend, RelationAppend, SelectAppend};

class CompanyRepo extends EloquentRepoAbstract implements CompanyRepoContract
{
    public function model(): string
    {
        return Company::class;
    }

    public function registeredPresentingCompanies()
    {
        return $this->appends([
            new RelationAppend('clients', [
                new PresentersAppend(),
                new RelationAppend('conferenceClients', [
                    new InConfAppend()
                ])
            ]),
            new EagerLoadAppend('clients', [
                new SelectAppend(['id', 'first_name', 'family_name'])
            ])
        ]);
    }
}
