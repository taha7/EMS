<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Services\ScheduleServices;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private $service, $request;


    public function __construct(Request $request, ScheduleServices $service)
    {
        $this->service = $service;
        $this->request = $request;
    }

    public function generateSchedule()
    {
        if ($this->request->wantsJson()) {
            return response()->json(
                $this->service->genereateSchedule()
            );
        }

        return view('schedule.index');
    }
}
