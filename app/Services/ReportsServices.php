<?php

namespace App\Services;

use App\Repositories\Eloquent\MeetingRepo\MeetingRepo;

class ReportsServices
{
    public function companyScheduleWithInvestorContacts()
    {
        return [
            'meetings' => (new MeetingRepo())->companyScheduleWithInvestorContactsData()
        ];
    }
}
