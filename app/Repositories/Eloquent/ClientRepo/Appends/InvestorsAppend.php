<?php

namespace App\Repositories\Eloquent\ClientRepo\Appends;

use App\Repositories\Contracts\AppendsContract;

class InvestorsAppend implements AppendsContract
{
    public function apply($model)
    {
        return $model->investors();
    }
}
