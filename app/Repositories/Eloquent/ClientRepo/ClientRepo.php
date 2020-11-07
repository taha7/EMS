<?php

namespace App\Repositories\Eloquent\ClientRepo;

use App\Models\User\Client;
use App\Repositories\Contracts\ClientRepoContract;
use App\Repositories\Eloquent\GlobalAppends\{
    InCompanyAppend,
    EagerLoadAppend,
    InConfAppend
};
use App\Repositories\Eloquent\ClientRepo\Appends\{
    ConferenceClientsAppend,
    InvestorsAppend
};
use App\Repositories\Eloquent\ConferenceClientRepo\Appends\RegisteredAppend;
use App\Repositories\Eloquent\EloquentRepoAbstract;

class ClientRepo extends EloquentRepoAbstract implements ClientRepoContract
{

    protected function model(): string
    {
        return Client::class;
    }

    public function list()
    {
        return $this->appends(array(
            new InvestorsAppend(),
            new ConferenceClientsAppend([
                new InConfAppend(),
                new RegisteredAppend()
            ]),
            new EagerLoadAppend('clientPreferences', [
                new InConfAppend(),
                new InCompanyAppend($this->request->company_id)
            ]),
            new EagerLoadAppend('company'),
            new EagerLoadAppend('clientType'),
            new EagerLoadAppend('country'),
            new EagerLoadAppend('title'),
            new EagerLoadAppend('primarySignatory'),
        ))->get();
    }
}
