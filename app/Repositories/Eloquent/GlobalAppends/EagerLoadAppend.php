<?php

namespace App\Repositories\Eloquent\GlobalAppends;

use App\Repositories\Contracts\AppendsContract;

class EagerLoadAppend implements AppendsContract
{
    /**
     * @var AppendsContract[] $appends
     */
    private $appends, $relation;


    public function __construct($relation, $appends = [])
    {
        $this->appends = $appends;
        $this->relation = $relation;
    }

    public function apply($model)
    {
        return $model->with([
            $this->relation => function ($relative) {
                foreach ($this->appends as $append) {
                    $append->apply($relative);
                }
            }
        ]);
    }
}
