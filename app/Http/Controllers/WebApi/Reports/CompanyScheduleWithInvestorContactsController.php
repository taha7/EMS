<?php

namespace App\Http\Controllers\WebApi\Reports;

use App\Http\Controllers\Controller;
use App\Services\ReportsServices;
use Illuminate\Http\Request;

class CompanyScheduleWithInvestorContactsController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke(ReportsServices $service)
    {

        if($this->request->wantsJson()) {
            return response()->json(
                $service->companyScheduleWithInvestorContacts()
            );
        }

        return view('reports.company-schedule-with-investor-contacts');

    }
}
