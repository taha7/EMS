<?php

namespace App\Repositories\Eloquent\CompanyRepo\Appends;

use App\Repositories\Contracts\AppendsContract;

class MeetingsAppend implements AppendsContract
{
    /**
     * @param AppendsContract[] $appends
     */
    public function __construct(array $appends = [])
    {
        $this->appends = $appends;
    }

    public function apply($model)
    {
        return $model->whereHas('meetings', function ($meetings) {
            foreach ($this->appends as $append) {
                $append->apply($meetings);
            }
        });
    }
}
