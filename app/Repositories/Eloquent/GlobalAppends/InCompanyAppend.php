<?php

namespace App\Repositories\Eloquent\GlobalAppends;

use App\Repositories\Contracts\AppendsContract;

class InCompanyAppend implements AppendsContract
{

    /**
     * @var int|string $companyId
     */
    private $companyId;

    public function __construct($companyId)
    {
        $this->companyId = $companyId;
    }

    public function apply($model)
    {
        return $model->withCompany($this->companyId);
    }
}
