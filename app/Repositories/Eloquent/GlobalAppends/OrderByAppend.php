<?php

namespace App\Repositories\Eloquent\GlobalAppends;

use App\Repositories\Contracts\AppendsContract;

class OrderByAppend implements AppendsContract
{
    private $column, $dir;

    public function __construct($column, $dir = 'asc')
    {
        $this->column = $column;
        $this->dir = $dir;
    }

    public function apply($model)
    {
        return $model->orderBy($this->column, $this->dir);
    }

    // /**
    //  * Determine if the value is a query builder instance or a Closure.
    //  *
    //  * @param  mixed  $value
    //  * @return bool
    //  */
    // protected function isQueryable($value)
    // {
    //     return $value instanceof self ||
    //            $value instanceof EloquentBuilder ||
    //            $value instanceof Closure;
    // }
}
