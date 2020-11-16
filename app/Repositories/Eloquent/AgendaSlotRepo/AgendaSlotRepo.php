<?php

namespace App\Repositories\Eloquent\AgendaSlotRepo;

use App\Models\Conference\AgendaSlot;
use App\Repositories\Contracts\AgendaSlotRepoContract;
use App\Repositories\Eloquent\AgendaSlotRepo\Appends\PrivateAndExceptionAppend;
use App\Repositories\Eloquent\EloquentRepoAbstract;
use App\Repositories\Eloquent\GlobalAppends\{EagerLoadAppend, InConfAppend, OrderByAppend, SelectAppend};

class AgendaSlotRepo extends EloquentRepoAbstract implements AgendaSlotRepoContract
{
    public function model(): string
    {
        return AgendaSlot::class;
    }

    public function listWithMeetings()
    {
        return $this->appends([
            new SelectAppend(['id', 'date', 'start_time', 'end_time', 'type', 'conference_id']),
            new PrivateAndExceptionAppend(),
            new InConfAppend(),
            new EagerLoadAppend('meetings', [
                new SelectAppend(['id', 'agenda_slot_id', 'company_id', 'client_id']),
                new EagerLoadAppend('agendaSlot'),
                new EagerLoadAppend('company', [
                    new SelectAppend(['id', 'name'])
                ]),
                new EagerLoadAppend('conferenceClient', [
                    new SelectAppend(['id', 'client_id', 'conference_id']),
                    new EagerLoadAppend('client', [
                        new SelectAppend(['id', 'first_name', 'family_name', 'company_id']),
                        new EagerLoadAppend('company')
                    ])
                ])
            ]),
            new OrderByAppend('date'),
            new OrderByAppend('start_time'),
        ])->get();
    }
}
