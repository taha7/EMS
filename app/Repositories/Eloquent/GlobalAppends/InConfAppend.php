<?php

namespace App\Repositories\Eloquent\GlobalAppends;

use App\Repositories\Contracts\AppendsContract;

class InConfAppend implements AppendsContract
{
    public function apply($model)
    {
        return $model->inConf();
    }
}
