<?php

namespace App\Repositories\Eloquent\MeetingRepo;

use App\Models\Conference\AgendaSlot;
use App\Models\Conference\Meeting;
use App\Repositories\Contracts\MeetingRepoContract;
use App\Repositories\Eloquent\EloquentRepoAbstract;
use App\Repositories\Eloquent\GlobalAppends\{EagerLoadAppend, InConfAppend, RelationAppend, SelectAppend};
use Illuminate\Support\Facades\DB;

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


    // public function companyScheduleWithInvestorContactsData()
    // {
    //     $appends = $this->appendsSelections([
    //         'select' => self::SELECT_FROM_BASIC_QUERY,
    //         'agendaSlotRelation' => self::SELECT_FROM_BASIC_QUERY,
    //         'agendaSlotLoad' => self::SELECT_FROM_BASIC_QUERY,
    //         'companyLoad' => self::SELECT_FROM_BASIC_QUERY,
    //         'conferenceClientLoad' => new EagerLoadAppend('conferenceClient', [
    //             new SelectAppend(['id', 'client_id']),
    //             new EagerLoadAppend('client', [
    //                 new SelectAppend(['id', 'company_id', 'first_name', 'family_name']),
    //                 // here is the diff with the basic query
    //                 new EagerLoadAppend('country', [
    //                     new SelectAppend(['id', 'name'])
    //                 ]),
    //                 new EagerLoadAppend('company', [
    //                     new SelectAppend(['id', 'name'])
    //                 ])
    //             ])
    //         ])
    //     ]);

    //     return $this->appends($appends)->get();
    // }

    // public function scheduleMeetings()
    // {
    //     return $this->appends($this->basicQueryAppends());
    // }

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

    public function generateSchedule()
    {
        // SELECT pc.name, ag.date, ag.start_time, ag.end_time, ic.name investor_company
        // FROM meetings m
        // JOIN companies pc
        // ON m.company_id = pc.id
        // JOIN agenda_slots ag
        // ON ag.id = m.agenda_slot_id
        // and ag.conference_id = 37
        // JOIN conference_clients cc
        // ON cc.id = m.client_id
        // JOIN clients c
        // ON c.id = cc.client_id
        // JOIN companies ic
        // ON ic.id = c.company_id
        // WHERE ic.id <> pc.id
        // ORDER BY pc.name, ag.date, ag.start_time, ic.name

        $meetings = Meeting::select(
            DB::raw('
                meetings.id meeting_id,
                meetings.agenda_slot_id agenda_slot_id,
                pc.id pres_comp_id,
                pc.name pres_comp,
                ic.id inv_comp_id,
                ic.name inv_comp,
                CONCAT(t.name, " ",  c.first_name, " ", c.family_name) full_titled_name,
                meetings.deleted_at
            ')
        )
        ->join(
            'companies AS pc',
            'pc.id',
            'meetings.company_id'
        )
        ->join('conference_clients AS cc', 'cc.id', 'meetings.client_id')
        ->join('clients AS c', 'c.id', 'cc.client_id')
        ->join('titles AS t', 't.id', 'c.title_id')
        ->join('companies AS ic', 'ic.id', 'c.company_id')
        ->getQuery();

        // return $meetings;



        return AgendaSlot::privateAndException()->
            select(DB::raw('agenda_slots.id agenda_id, date, start_time, m.meeting_id meeting_id, m.pres_comp, m.inv_comp, m.full_titled_name'))
            ->leftJoinSub($meetings, 'm', 'm.agenda_slot_id', 'agenda_slots.id')
            ->where('agenda_slots.conference_id', 37)
            ->whereNull('m.deleted_at')
            ->whereNull('agenda_slots.deleted_at')
            // ->whereColumn('pres_comp_id', '<>', 'inv_comp_id')
            ->orderBy('agenda_slots.date')
            ->orderBy('pres_comp')
            ->orderBy('agenda_slots.start_time')
            ->orderBy('inv_comp')
            ->get()
            ->groupBy(['date', 'pres_comp']);

            // ->join('companies AS pc', 'pc.id', 'm.company_id')
            // ->join('conference_clients AS cc', 'cc.id', 'm.client_id')
            // ->join('clients AS c', 'c.id', 'cc.client_id')
            // ->join('titles AS t', 't.id', 'c.title_id')
            // ->join('companies AS ic', 'ic.id', 'c.company_id')
            // ->where('agenda_slots.conference_id', 37)
            // ->whereNull('m.deleted_at')
            // ->whereNull('agenda_slots.deleted_at')
            // ->whereColumn('ic.id', '<>', 'pc.id')
            // ->orderBy('pc.name')
            // ->orderBy('agenda_slots.date')
            // ->orderBy('agenda_slots.start_time')
            // ->orderBy('ic.name')
            // ->get();

        // return DB::table('meetings AS m')
        //     ->select(
        //         DB::raw('pc.name pres_comp, ag.date, ag.start_time, ag.end_time, ag.id agenda_id, ic.name, CONCAT(t.name, " ",  c.first_name, " ", c.family_name) full_titled_name')
        //     )
        //     ->join('companies AS pc', 'pc.id', 'm.company_id')
        //     ->join('agenda_slots AS ag', 'ag.id', 'm.agenda_slot_id')
        //     ->join('conference_clients AS cc', 'cc.id', 'm.client_id')
        //     ->join('clients AS c', 'c.id', 'cc.client_id')
        //     ->join('titles AS t', 't.id', 'c.title_id')
        //     ->join('companies AS ic', 'ic.id', 'c.company_id')
        //     ->where('ag.conference_id', 37)
        //     ->whereNull('m.deleted_at')
        //     ->whereNull('ag.deleted_at')
        //     ->whereColumn('ic.id', '<>', 'pc.id')
        //     ->orderBy('pc.name')
        //     ->orderBy('ag.date')
        //     ->orderBy('ag.start_time')
        //     ->orderBy('ic.name')
        //     ->get()
        //     ->groupBy(['pres_comp', 'date', 'start_time']);
    }
}
