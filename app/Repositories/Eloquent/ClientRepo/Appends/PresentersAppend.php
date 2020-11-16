<?php

namespace App\Repositories\Eloquent\ClientRepo\Appends;

use App\Repositories\Contracts\AppendsContract;

class PresentersAppend implements AppendsContract
{
    public function apply($model)
    {
        return $model->presenters();
    }
}
