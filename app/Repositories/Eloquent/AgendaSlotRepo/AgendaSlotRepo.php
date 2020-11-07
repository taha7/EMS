<?php

namespace App\Repositories\Eloquent\AgendaSlotRepo;

use App\Models\Conference\AgendaSlot;
use App\Repositories\Contracts\AgendaSlotRepoContract;
use App\Repositories\Eloquent\EloquentRepoAbstract;
use App\Repositories\Eloquent\GlobalAppends\{EagerLoadAppend, InConfAppend, SelectAppend};

class AgendaSlotRepo extends EloquentRepoAbstract implements AgendaSlotRepoContract
{
    public function model(): string
    {
        return AgendaSlot::class;
    }

    public function generateSchedule()
    {
        return $this->appends([
            new InConfAppend(),
            new EagerLoadAppend('meetings', [
                new EagerLoadAppend('company', [
                    new SelectAppend(['id', 'name'])
                ]),
                new SelectAppend(['id', 'agenda_slot_id', 'company_id', 'client_id'])
            ]),
            new SelectAppend(['id', 'date', 'start_time', 'end_time', 'type', 'conference_id'])
        ])->get();
    }
}
