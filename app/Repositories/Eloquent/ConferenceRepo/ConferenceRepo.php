<?php

namespace App\Repositories\Eloquent\ConferenceRepo;

use App\Models\Conference\Conference;
use App\Repositories\Contracts\ConferenceRepoContract;
use App\Repositories\Eloquent\EloquentRepoAbstract;
use Carbon\Carbon;

class ConferenceRepo extends EloquentRepoAbstract implements ConferenceRepoContract
{

    protected function model(): string
    {
        return Conference::class;
    }

    public function basicQueryAppends() {
        return [];
    }

    /**
     * list conference dates
     * @param Conference $conf
     * @return Illuminate\Support\Collection list of dates
     */
    public function conferenceDates($conf)
    {
        return $this->dateInterval($conf->start_date, $conf->end_date);
    }

    /**
     * get all dates between 2 dates
     * @param  string $start_date date of string
     * @param  string $end_date   date of end
     * @param  string $format     format ex Y-m-d
     * @return Illuminate\Support\Collection list of dates
     */
    protected function dateInterval($startDate, $endDate, $format = 'Y-m-d')
    {
        $period = new \DatePeriod(
            new \DateTime($startDate),
            new \DateInterval('P1D'),
            new \DateTime(
                Carbon::parse($endDate)->addDay()->format($format)
            )
        );

        return collect($period)->map(function ($date) use ($format) {
            return $date->format($format);
        });
    }
}
