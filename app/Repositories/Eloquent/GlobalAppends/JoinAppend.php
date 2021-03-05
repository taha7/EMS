<?php

namespace App\Repositories\Eloquent\GlobalAppends;

use App\Repositories\Contracts\AppendsContract;

class JoinAppend implements AppendsContract
{
    private $table, $first, $operator, $second, $type, $where;

    public function __construct($table, $first, $operator = null, $second = null, $type = 'inner', $where = false)
    {
        $this->table = $table;
        $this->first = $first;
        $this->operator = $operator;
        $this->second = $second;
        $this->type = $type;
        $this->where = $where;
    }

    public function apply($query)
    {
        return $query->join($this->table, $this->first, $this->operator, $this->second, $this->type, $this->where);
    }
}
