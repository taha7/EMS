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

    public function basicQueryAppends()
    {
        return [
            'select' => new SelectAppend(['id', 'agenda_slot_id', 'company_id', 'client_id']),
            'agendaSlotRelation' => new RelationAppend('agendaSlot', [
                new InConfAppend()
            ]),
            'agendaSlotLoad' => new EagerLoadAppend('agendaSlot', [
                new SelectAppend(['id', 'date', 'start_time', 'end_time', 'conference_id'])
            ]),
            'companyLoad' => new EagerLoadAppend('company', [
                new SelectAppend(['id', 'name'])
            ]),
            'conferenceClientLoad' => new EagerLoadAppend('conferenceClient', [
                new SelectAppend(['id', 'client_id']),
                new EagerLoadAppend('client', [
                    new SelectAppend(['id', 'company_id', 'first_name', 'family_name']),
                    new EagerLoadAppend('company', [
                        new SelectAppend(['id', 'name'])
                    ])
                ])
            ])
        ];
    }


    public function companyScheduleWithInvestorContactsData()
    {
        $appends = $this->appendsSelections([
            'select' => self::SELECT_FROM_BASIC_QUERY,
            'agendaSlotRelation' => self::SELECT_FROM_BASIC_QUERY,
            'agendaSlotLoad' => self::SELECT_FROM_BASIC_QUERY,
            'companyLoad' => self::SELECT_FROM_BASIC_QUERY,
            'conferenceClientLoad' => new EagerLoadAppend('conferenceClient', [
                new SelectAppend(['id', 'client_id']),
                new EagerLoadAppend('client', [
                    new SelectAppend(['id', 'company_id', 'first_name', 'family_name']),
                    // here is the diff with the basic query
                    new EagerLoadAppend('country', [
                        new SelectAppend(['id', 'name'])
                    ]),
                    new EagerLoadAppend('company', [
                        new SelectAppend(['id', 'name'])
                    ])
                ])
            ])
        ]);

        return $this->appends($appends)->get();
    }

    public function scheduleMeetings()
    {
        return $this->appends($this->basicQueryAppends());
    }

    // public function generateSchedule()
    // {
    //     return $this->appends([
    //         new SelectAppend(['id', 'agenda_slot_id', 'company_id', 'client_id']),
    //         new RelationAppend('agendaSlot', [
    //             new InConfAppend()
    //         ]),
    //         new EagerLoadAppend('agendaSlot', [
    //             new SelectAppend(['id', 'date', 'start_time', 'end_time', 'type', 'conference_id'])
    //         ]),
    //         new EagerLoadAppend('company', [
    //             new SelectAppend(['id', 'name'])
    //         ])
    //     ])->get();
    //     // new InConfAppend(),
    //     //     new EagerLoadAppend('meetings', [
    //     //         new EagerLoadAppend('company', [
    //     //             new SelectAppend(['id', 'name'])
    //     //         ]),
    //     //         new SelectAppend(['id', 'agenda_slot_id', 'company_id', 'client_id'])
    //     //     ]),
    //     //     new SelectAppend(['id', 'date', 'start_time', 'end_time', 'type', 'conference_id'])
    // }
}
