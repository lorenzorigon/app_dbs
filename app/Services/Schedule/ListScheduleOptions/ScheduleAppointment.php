<?php

namespace App\Services\Schedule\ListScheduleOptions;

use Carbon\Carbon;

class ScheduleAppointment
{
    private Carbon $date;

    public function __construct(Carbon $date)
    {
        $this->date = $date;
    }
}
