<?php

namespace App\Repositories\Eloquent\GlobalAppends;

use App\Repositories\Contracts\AppendsContract;

class SelectAppend implements AppendsContract
{

    private $selections;

    public function __construct(array $selections)
    {
        $this->selections = $selections;
    }

    public function apply($model)
    {
        return $model->select($this->selections);
    }
}
