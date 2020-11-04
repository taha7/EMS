<?php

namespace App\Repositories\Eloquent;

use App\Models\User\Client;
use App\Repositories\Contracts\InvestorsRepoContract;

class InvestorsRepo extends EloquentRepoAbstract implements InvestorsRepoContract
{

    protected function model()
    {
        return Client::class;
    }


    public function queryAll($eagerLoads = [])
    {
        return $this->model->take(10)->get();
    }


    public function paginate()
    {
        return $this->model
            ->investors()
            ->whereHas('conferenceClients', function ($q) {
                $q->inConf()->registered();
            })
            ->with(
                [
                    'clientPreferences' => function ($preferences) {
                        $preferences->inConf()->withCompany(request('company_id'));
                    },
                    'company',
                    'clientType',
                    'company',
                    'country',
                    'title',
                    'primarySignatory'
                ]
            );
        // return CC::inConf()
        //     ->registered()
        //     ->whereHas('client', function ($clients) {
        //         $clients->investors();
        //     })
        //     ->with(['client' => function ($clients) {
        //         $clients->with([
        //             'clientPreferences' => function ($preferences) {
        //                 $preferences->inConf()->withCompany(request('company_id'));
        //             },
        //             'company',
        //             'clientType',
        //             'company',
        //             'country',
        //             'title',
        //             'primarySignatory'
        //         ]);
        //     }])
        //     ->take(10)->get();
    }
}
