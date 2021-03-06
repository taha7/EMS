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
        $companies = $this->companyRepo->registeredPresentingCompanies()->paginate(20);
        request()->merge(['companies' => collect($companies->jsonSerialize()['data'])->pluck('id')->toArray()]);
        
        $this->agendaSlotRepo->allowFilters();
        $this->agendaSlotRepo->filterWith(['companies']);
        
        return [
            'dates' => $this->conferenceRepo->conferenceDates($this->conferenceRepo->find(request()->conference_id ?? 37)),
            'companiesPagination' => $companies,
            'scheduleAgendaSlots' =>  ScheduleSlotsResource::collection($this->agendaSlotRepo->listWithMeetings())
        ];
    }
}
