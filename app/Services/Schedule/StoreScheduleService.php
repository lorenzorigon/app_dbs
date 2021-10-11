<?php

namespace App\Services\Schedule;

use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class StoreScheduleService
{
    public function store(User $user, string $day, string $hour, int $service): Schedule
    {
        $this->validateHour($day, $hour, $service);

        $schedule = new Schedule();
        $schedule->schedule = sprintf('%s %s', $day, $hour);
        $schedule->service = $service;
        $schedule->user_id = $user->id;

        $schedule->save();
        return $schedule;
    }

    private function validateHour($day, $hour, $service)
    {
        $scheduleServiceDuration = Schedule::SERVICE_DURATIONS[$service];
        $scheduleStartDate = Carbon::createFromFormat('Y-m-d H:i', sprintf('%s %s', $day, $hour));
        $scheduleEndDate = $scheduleStartDate->clone()->addMinutes($scheduleServiceDuration);

        $existsSchedule = Schedule::query()
            ->whereBetween('schedule', [$scheduleStartDate->format('Y-m-d H:i'), $scheduleEndDate->subMinute()->format('Y-m-d H:i')])
            ->exists();

        if ($existsSchedule) {
            throw new UnprocessableEntityHttpException('Não foi possível agendar nesse horário, pois já existe outro agendamento!');
        }
    }
}
