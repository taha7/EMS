<?php

namespace App\Repositories\Eloquent\CompanyRepo;

use App\Models\Lookups\Company;
use App\Repositories\Contracts\CompanyRepoContract;
use App\Repositories\Eloquent\EloquentRepoAbstract;
use App\Repositories\Eloquent\GlobalAppends\{EagerLoadAppend, InConfAppend, RelationAppend};

class CompanyRepo extends EloquentRepoAbstract implements CompanyRepoContract
{
    public function model(): string
    {
        return Company::class;
    }

    public function getCompaniesSchedule()
    {
        return $this->appends([
            new RelationAppend('meetings', [
                new RelationAppend('agendaSlot', [
                    new InConfAppend()
                ])
            ]),
            new EagerLoadAppend('meetings', [
                new RelationAppend('agendaSlot', [
                    new InConfAppend()
                ])
            ])
        ])->get();
    }
}
