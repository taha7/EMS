<?php

namespace App\Services;

use App\Repositories\Contracts\ClientRepoContract;

class InvestorsServices
{
    private $repo;

    public function __construct(ClientRepoContract $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->list();
    }
}
