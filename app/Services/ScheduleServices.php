<?php

namespace App\Services;

use App\Repositories\Eloquent\MeetingRepo\MeetingRepo;

class ScheduleServices
{
    private $repo;

    public function __construct(MeetingRepo $repo)
    {
        $this->repo = $repo;
    }

    public function genereateSchedule()
    {
        return $this->repo->generateSchedule();
    }
}
