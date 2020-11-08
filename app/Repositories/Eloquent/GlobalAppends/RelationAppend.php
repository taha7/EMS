<?php

namespace App\Repositories\Eloquent\GlobalAppends;

use App\Repositories\Contracts\AppendsContract;

class RelationAppend implements AppendsContract
{
    private $relation;

    /**
     * @var AppendsContract[] $appends
     */
    private $appends;

    public function __construct($relation, array $appends = [])
    {
        $this->relation = $relation;
        $this->appends = $appends;
    }

    public function apply($model)
    {
        return $model->whereHas($this->relation, function ($relative) {
            foreach ($this->appends as $append) {
                $append->apply($relative);
            }
        });
    }
}
