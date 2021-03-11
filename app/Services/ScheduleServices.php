<?php

namespace App\Services;

use App\Http\Resources\WepApi\ScheduleSlotsResource;
use App\Repositories\Eloquent\AgendaSlotRepo\AgendaSlotRepo;
use App\Repositories\Eloquent\CompanyRepo\CompanyRepo;
use App\Repositories\Eloquent\ConferenceRepo\ConferenceRepo;

class ScheduleServices
{
    private $agendaSlotRepo, $conferenceRepo, $companyRepo;

    public function __construct(AgendaSlotRepo $agendaSlotRepo, ConferenceRepo $conferenceRepo, CompanyRepo $companyRepo)
    {
        $this->agendaSlotRepo = $agendaSlotRepo;
        $this->conferenceRepo = $conferenceRepo;
        $this->companyRepo = $companyRepo;
    }

    public function genereateSchedule()
    {
        return [
            'dates' => $this->conferenceRepo->conferenceDates($this->conferenceRepo->find(request()->conference_id ?? 37)),
            'companies' => $this->companyRepo->registeredPresentingCompanies()->take(171)->get(),
            'scheduleAgendaSlots' =>  ScheduleSlotsResource::collection($this->agendaSlotRepo->listWithMeetings())
        ];
    }
}
