<?php

namespace App\Repositories\Eloquent\AgendaSlotRepo;

use App\Models\Conference\AgendaSlot;
use App\Repositories\Contracts\AgendaSlotRepoContract;
use App\Repositories\Eloquent\AgendaSlotRepo\Appends\PrivateAndExceptionAppend;
use App\Repositories\Eloquent\EloquentRepoAbstract;
use App\Repositories\Eloquent\GlobalAppends\{EagerLoadAppend, InConfAppend, JoinAppend, OrderByAppend, RelationAppend, SelectAppend, WhereInAppend};
use Illuminate\Support\Facades\DB;
use League\Flysystem\SafeStorage;

class AgendaSlotRepo extends EloquentRepoAbstract implements AgendaSlotRepoContract
{
    private $additionalMeetingsAppends = [];


    public function model(): string
    {
        return AgendaSlot::class;
    }

    public function basicQueryAppends()
    {
        return [];
    }

    protected function filtersAppends()
    {
        return [
            'companies' => function ($ids) {
                $this->additionalMeetingsAppends[] = new WhereInAppend('id', $ids);
            }
        ];
    }

    private function listWithMeetingsQuery()
    {
        return $this->appends([
            new SelectAppend(['id', 'date', 'start_time', 'end_time', 'type', 'conference_id']),
            new PrivateAndExceptionAppend(),
            new InConfAppend(),
            new EagerLoadAppend(
                'meetings',
                array_merge([
                    new SelectAppend(['id', 'agenda_slot_id', 'company_id', 'client_id']),
                    new EagerLoadAppend('agendaSlot'),
                    new EagerLoadAppend('company', [
                        new SelectAppend(['id', 'name'])
                    ]),
                    new EagerLoadAppend('conferenceClient', [
                        new SelectAppend(['id', 'client_id', 'conference_id']),
                        new EagerLoadAppend('client', [
                            new SelectAppend(['clients.id', 'first_name', 'family_name', 'company_id', DB::raw("CONCAT(titles.name, ' ', first_name, ' ', family_name) full_titled_name")]),
                            new EagerLoadAppend('company'),
                            new JoinAppend('titles', 'titles.id', 'clients.title_id')
                        ])
                    ])
                ], $this->additionalMeetingsAppends)
            ),
            new OrderByAppend('date'),
            new OrderByAppend('start_time'),
        ]);
    }

    public function listWithMeetings()
    {
        // first check if there are filters on query
        if ($this->allowFilters) {
            $this->appendFilters();
        }

        return $this->listWithMeetingsQuery()->get()->groupBy(['date']);
    }
}
