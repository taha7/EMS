<?php

namespace App\Repositories\Eloquent\ClientRepo\Appends;

use App\Repositories\Contracts\AppendsContract;

class ConferenceClientsAppend implements AppendsContract
{
    private $appends = [];

    /**
     * @param AppendsContract[] $appends
     */
    public function __construct(array $appends = [])
    {
        $this->appends = $appends;
    }

    public function apply($model)
    {
        return $model->whereHas('conferenceClients', function ($cc) {
            foreach ($this->appends as $append) {
               $cc = $append->apply($cc);
            }
            return $cc;
        });
    }
}
