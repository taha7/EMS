<?php

namespace App\Repositories\Eloquent\GlobalAppends;

use App\Repositories\Contracts\AppendsContract;

class WhereInAppend implements AppendsContract
{
    private $values;
    
    public function __construct($key, $values)
    {
        $this->key = $key;
        $this->values = $values;
    }

    public function apply($query)
    {
        return $query->whereIn($this->key, $this->values);
    }
}
