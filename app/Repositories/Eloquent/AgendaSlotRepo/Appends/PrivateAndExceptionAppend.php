<?php

namespace App\Repositories\Eloquent\AgendaSlotRepo\Appends;

use App\Repositories\Contracts\AppendsContract;

class PrivateAndExceptionAppend implements AppendsContract
{
    public function apply($model)
    {
        return $model->privateAndException();
    }
}
