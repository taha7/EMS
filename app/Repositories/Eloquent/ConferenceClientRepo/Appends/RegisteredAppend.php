<?php

namespace App\Repositories\Eloquent\ConferenceClientRepo\Appends;

use App\Repositories\Contracts\AppendsContract;

class RegisteredAppend implements AppendsContract
{
    public function apply($model)
    {
        return $model->registered();
    }
}
