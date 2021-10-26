<?php
namespace App\Services\Schedule\ListScheduleOptions;

use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class ListAppointmentService
{
    private const START_HOUR = '13:00';
    private const END_HOUR = '19:30';

    private Collection $dayAppointments;

    private $appointments = [];

    public function list(string $day, int $service, User $user)
    {
        $this->dayAppointments = Schedule::query()->whereDate('start_at', $day)->get();
        $serviceTime = Schedule::SERVICE_DURATIONS[$service];

        $currentTime = Carbon::createFromFormat('H:i', self::START_HOUR);
        $endTime = Carbon::createFromFormat('H:i', self::END_HOUR);

        while ($currentTime->isBefore($endTime->addMinute())) {
            $appointment = new ScheduleAppointment();
            $appointment->setDay($day);
            $appointment->setHour($currentTime->format('H:i'));

            $scheduleAtTime = $this->getAppointmentAtTime($currentTime);

            if ($scheduleAtTime) {
                if ($scheduleAtTime->user_id == $user->id) {
                    $appointment->setFilledByUser(true);
                } else {
                    $appointment->setFilledByOther(true);
                }
            }

            array_push($this->appointments, $appointment->toArray());

            $currentTime->addMinutes($serviceTime);
        }

        return $this->appointments;
    }

    private function getAppointmentAtTime(Carbon $time): ?Schedule
    {
        return $this->dayAppointments->first(function (Schedule $schedule) use ($time) {
            $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $schedule->start_at);
            $endAt = Carbon::createFromFormat('Y-m-d H:i:s', $schedule->end_at);

            return $startAt->subMinute()->isBefore($time) && $endAt->isAfter($time);
        });
    }
}

