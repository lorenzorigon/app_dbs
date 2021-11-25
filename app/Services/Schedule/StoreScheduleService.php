<?php

namespace App\Services\Schedule;

use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class StoreScheduleService
{
    public function store(User $user, string $day, string $hour, int $service): Schedule
    {
        $startAt = Carbon::createFromFormat('Y-m-d H:i', sprintf('%s %s', $day, $hour));
        $endAt = $startAt->clone()->addMinutes(Schedule::SERVICE_DURATIONS[$service]);
        $this->validateHour($startAt, $endAt);

        $schedule = new Schedule();
        $schedule->start_at = $startAt->format('Y-m-d H:i');
        $schedule->end_at = $endAt->format('Y-m-d H:i');
        $schedule->service = $service;
        $schedule->user_id = $user->id;

        $schedule->save();
        return $schedule;
    }

    /**
     * 10:00 > 10:30
     *
     * SELECT * FROM schedules WHERE (start_at >= '2021-10-23 14:30' OR end_at <= '2021-10-23 14:30') AND (start_at >= '2021-10-23 15:30' OR end_at >= '2021-10-23 15:30')
     *
     */
    private function validateHour(Carbon $startAt, Carbon $endAt)
    {
        $existsSchedule = Schedule::query()
            ->where(function (Builder $builder) use ($startAt) {
                $builder->where('start_at', '<=', $startAt->format('Y-m-d H:i'))
                    ->where('end_at', '>', $startAt->format('Y-m-d H:i'));
            })
            ->orWhere(function (Builder $builder) use ($endAt) {
                $builder->where('start_at', '<', $endAt->format('Y-m-d H:i'))
                    ->where('end_at', '>=', $endAt->format('Y-m-d H:i'));
            })
            ->exists();


        if ($existsSchedule || ($startAt < Carbon::now()->format('Y-m-d'))) {
            throw new UnprocessableEntityHttpException('Não foi possível agendar nesse horário, pois já existe outro agendamento!');
        }
    }
}
