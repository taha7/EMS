<?php

namespace App\Services;

use App\Repositories\Eloquent\ClientRepo\ClientRepo;

class InvestorsServices
{
    private $repo;

    public function __construct(ClientRepo $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->listInvestors();
    }
}
