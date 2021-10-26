<?php

namespace App\Services\Schedule\ListScheduleOptions;

use Carbon\Carbon;

class ScheduleAppointment
{
    private string $day;

    private string $hour;

    private bool $filledByOther = false;

    private bool $filledByUser = false;

    public function setDay(string $day)
    {
        $this->day = $day;
    }

    public function setHour(string $hour)
    {
        $this->hour = $hour;
    }

    public function setFilledByOther(string $filledByOther)
    {
        $this->filledByOther = $filledByOther;
    }

    public function setFilledByUser(string $filledByUser)
    {
        $this->filledByUser = $filledByUser;
    }

    public function toArray()
    {
        return [
            'day' => $this->day,
            'hour' => $this->hour,
            'filledByOther' => $this->filledByOther,
            'filledByUser' => $this->filledByUser,
        ];
    }
}
