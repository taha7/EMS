<?php

namespace App\Repositories\Eloquent\MeetingRepo;

use App\Models\Conference\Meeting;
use App\Repositories\Contracts\MeetingRepoContract;
use App\Repositories\Eloquent\EloquentRepoAbstract;
use App\Repositories\Eloquent\GlobalAppends\{EagerLoadAppend, InConfAppend, RelationAppend, SelectAppend};

class MeetingRepo extends EloquentRepoAbstract implements MeetingRepoContract
{
    public function model(): string
    {
        return Meeting::class;
    }

    public function generateSchedule()
    {
        return $this->appends([
            new SelectAppend(['id', 'agenda_slot_id', 'company_id', 'client_id']),
            new RelationAppend('agendaSlot', [
                new InConfAppend()
            ]),
            new EagerLoadAppend('agendaSlot', [
                new SelectAppend(['id', 'date', 'start_time', 'end_time', 'type', 'conference_id'])
            ]),
            new EagerLoadAppend('company', [
                new SelectAppend(['id', 'name'])
            ])
        ])->get();
        // new InConfAppend(),
        //     new EagerLoadAppend('meetings', [
        //         new EagerLoadAppend('company', [
        //             new SelectAppend(['id', 'name'])
        //         ]),
        //         new SelectAppend(['id', 'agenda_slot_id', 'company_id', 'client_id'])
        //     ]),
        //     new SelectAppend(['id', 'date', 'start_time', 'end_time', 'type', 'conference_id'])
    }
}
