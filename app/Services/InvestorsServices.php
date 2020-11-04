<?php

namespace App\Services;

use App\Repositories\Contracts\InvestorsRepoContract;

class InvestorsServices
{
    private $repo;

    public function __construct(InvestorsRepoContract $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->queryAll();
    }
}
