<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Resources\WepApi\ScheduleResource;
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
            // return ScheduleResource::collection(
                return $this->service->genereateSchedule()->groupBy(['agendaSlot.date', 'company.name']);
            // );
        }

        return view('schedule.index');
    }
}
