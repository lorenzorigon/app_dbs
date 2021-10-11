<?php
namespace App\Services\Schedule\ListScheduleOptions;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ListScheduleOptionsService
{
    private const AVAILABLE_GAP = 7;

    private const START_HOUR = '13:00';
    private const END_HOUR = '19:30';

    private $appointments = [];

    public function listOptions()
    {
        for ($i = 0; $i < self::AVAILABLE_GAP; $i++) {
            $baseDate = Carbon::now()->addDays($i);
            $hour = Carbon::createFromFormat('Y-m-d H:i', sprintf('%s %s',  $baseDate->format('Y-m-d'), self::START_HOUR));
            $endHour = Carbon::createFromFormat('Y-m-d H:i', sprintf('%s %s',  $baseDate->format('Y-m-d'), self::END_HOUR));

            while ($hour->isBefore($endHour)) {
                $appointment = new ScheduleAppointment($hour);
                $this->appointments[$hour->format('Y-m-d')][] = $hour;

                $hour->addMinutes(30);
            }
            $hour = Carbon::createFromFormat('Y-m-d H:i', sprintf('%s %s',  $baseDate->format('Y-m-d'), self::START_HOUR));
            //popula dados do agendamento


        }
        dd($this->appointments);

    }
}

