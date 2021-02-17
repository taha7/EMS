<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Services\InvestorsServices;
use Illuminate\Http\Request;

class InvestorsController extends Controller
{
    /**
     *
     * @var Request $request
     */
    private $request;

    private $service;

    /**
     * @param Request $request
     */
    public function __construct(Request $request, InvestorsServices $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    public function index()
    {

        $investors = $this->service->getAll();

        return response()->json($investors);

        // return view('investors.index', compact(array('investors')));

        // $conf = $this->auth()->conference;

        // $date_lists = $this->auth()->conference->conferenceDates()->toArray();

        // $investors = $conf->clients()
        //     ->with(['client_preferences' => function ($query) use ($conf) {
        //         $query->where(['conference_id' => $conf->id, 'company_id' => request('company_id')]);
        //     }, 'conferencesClients' => function ($query) {
        //         $query->inConf()->registered()->with(['presenter_property', 'meetings']);
        //     }, 'client_type', 'company', 'country', 'title', 'primary_signatory', 'secondary_signatory'])
        //     ->investors()
        //     ->whereHas('conferencesClients', function ($query) {
        //         $query->inConf()->registered();
        //     });

        //     if(request()->get('agenda_slot_id')) {
        //         $meetingConflict = DB::raw(
        //             "(select client_id as sub_client_id, count(meetings_in_slot.id) as meetingConflict from meetings as meetings_in_slot
        //             where meetings_in_slot.agenda_slot_id = {$this->request->agenda_slot_id}
        //             and meetings_in_slot.deleted_at is null
        //             group by meetings_in_slot.client_id
        //         ) as meeting_conflict"
        //         );

        //         $meetingsWithCompany = DB::raw(
        //             "(select meetings_with_company.client_id as sub_client_id, count(meetings_with_company.id) as scheduledWithSameCompany from meetings as meetings_with_company
        //             where meetings_with_company.company_id = {$this->request->company_id}
        //             and meetings_with_company.deleted_at is null
        //             group by meetings_with_company.client_id
        //         ) as scheduled_with_same_company"
        //         );

        //         $privateSlotType = AgendaSlots::PRIVATE_MEETING;
        //         $countTotalMeetings = DB::raw(
        //             "(select private_metings.client_id as sub_client_id, count(ags.id) as countTotalMeeting from meetings as private_metings, agenda_slots ags, conference_clients cc
        //             where ags.id = private_metings.agenda_slot_id
        //             and cc.id = private_metings.client_id
        //             and ags.type = {$privateSlotType}
        //             and ags.deleted_at is null
        //             and private_metings.deleted_at is null
        //             and (JSON_CONTAINS(cc.available_slot, private_metings.agenda_slot_id) or cc.available_slot like  CONCAT('%\"', private_metings.agenda_slot_id, '\"%') )
        //             group by private_metings.client_id
        //         ) as count_total_meetings"
        //         );

        //         $requestSlot = AgendaSlots::find($this->request->agenda_slot_id);
        //         $countTotalMeetingsInDay = DB::raw(
        //             "(select private_metings_in_day.client_id as sub_client_id, count(distinct ags.id) as countTotalMeetingInDay from meetings as private_metings_in_day, agenda_slots ags, conference_clients cc
        //             where ags.id = private_metings_in_day.agenda_slot_id
        //             and cc.id = private_metings_in_day.client_id
        //             and ags.type = {$privateSlotType}
        //             and ags.deleted_at is null
        //             and private_metings_in_day.deleted_at is null
        //             and ags.date = '{$requestSlot->date}'
        //             and (JSON_CONTAINS(cc.available_slot, private_metings_in_day.agenda_slot_id) or cc.available_slot like  CONCAT('%\"', private_metings_in_day.agenda_slot_id, '\"%') )
        //             group by private_metings_in_day.client_id
        //         ) as count_total_meetings_in_day"
        //         );

        //         $investors = $investors
        //             ->leftJoin($meetingsWithCompany, 'conference_clients.id', 'scheduled_with_same_company.sub_client_id')
        //             ->leftJoin($meetingConflict, 'conference_clients.id', 'meeting_conflict.sub_client_id')
        //             ->leftJoin($countTotalMeetings, 'conference_clients.id', 'count_total_meetings.sub_client_id')
        //             ->leftJoin($countTotalMeetingsInDay, 'conference_clients.id', 'count_total_meetings_in_day.sub_client_id')
        //             ->select(["*", DB::raw("(
        //                 case
        //                     WHEN countTotalMeeting >= JSON_LENGTH(conference_clients.available_slot) THEN 5
        //                     WHEN countTotalMeetingInDay >= (
        //                         select count(ags.id) from agenda_slots ags
        //                         where (JSON_CONTAINS(conference_clients.available_slot, ags.id) or conference_clients.available_slot like  CONCAT('%\"', ags.id, '\"%'))
        //                         and ags.date = '{$requestSlot->date}'
        //                         and ags.type = {$privateSlotType}
        //                         and ags.deleted_at is null
        //                     ) THEN 6
        //                     WHEN scheduledWithSameCompany > 0 THEN 3
        //                     WHEN meetingConflict > 0 THEN 2
        //                     WHEN not JSON_CONTAINS (conference_clients.available_slot, {$this->request->agenda_slot_id}) THEN 4
        //                     ELSE 1
        //                 END
        //             ) coded_schedule_status")]);
        //     }

        // // means this is the first page of pagination
        // if(!request()->has('page')) {
        //     $selectedInvs = (new InvestorsRepository($conf->id))
        //         ->investorsInSlotWithCompany($this->request->agenda_slot_id, $this->request->company_id)
        //         ->get();
        // }


        // $query =  ClientFilter::apply(request(), $investors);

        // // order by selected investores
        // if (request()->has('filterInvestors') && !empty(request('filterInvestors'))) {
        //     $query = $query
        //         ->orderByRaw("FIELD(client_id, " .  implode(",", request('filterInvestors')) . ") DESC");
        // }

        // $query = ClientSortFilter::apply(new Request(request()->only('sort_by')), $query);

        // if(!str_contains(request()->sort_by,'in_slot_sort'))
        //     $query = (new ClientSortFilter())->sort_by($query,'in_slot_sort,asc');
        // if(!str_contains(request()->sort_by,'in_pref'))
        //     $query = (new ClientSortFilter())->sort_by($query,'in_pref_sort,desc');
        // if(!str_contains(request()->sort_by,'company'))
        //     $query = (new ClientSortFilter())->sort_by($query,'company,asc');
        // if(!str_contains(request()->sort_by,'name'))
        //     $query = (new ClientSortFilter())->sort_by($query,'name,asc');

        // $investorsRes = new InvestorsCollection($query->paginate(30));
        // $specs = ['company_id' => $this->request->company_id, 'agenda_slot_id' => $this->request->agenda_slot_id];
        // $company_slot_meetings = $this->model->where($specs)->get();
        // return [
        //     'paginatedInvs' =>  $investors,
        //     'investors' => $investorsRes,
        //     'date_lists' => $date_lists,
        //     'meetings' => $company_slot_meetings,
        //     'selectedInvs' => $selectedInvs ?? []
        // ];
    }
}
