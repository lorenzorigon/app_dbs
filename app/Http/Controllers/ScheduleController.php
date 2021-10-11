<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Services\Schedule\ListScheduleOptions\ListScheduleOptionsService;
use App\Services\Schedule\StoreScheduleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::where('user_id', auth()->user()->id)->get();
        return view('myschedules', ['schedules' => $schedules]);
    }

    public function dailySchedules()
    {
        $schedules = Schedule::query()->whereDate('schedule', date('Y-m-d'))->with('user')->get();
        return view('admin.schedules', ['schedules' => $schedules]);
    }

    public function create()
    {
        /*$options = new ListScheduleOptionsService();
        $options->listOptions();*/

        return view('schedule_create', ['message' => '']);
    }

    public function store(Request $request)
    {
        $request->validate(Schedule::rules(), Schedule::feedback());
        $scheduleData = $request->only('day', 'hour', 'service');

        $schedulingService = new StoreScheduleService();
        try{
            $schedulingService->store(auth()->user(), $scheduleData['day'], $scheduleData['hour'], $scheduleData['service']);
        }catch (UnprocessableEntityHttpException){
            return view('schedule_create', ['message' => 'Já existe um agendamento nesse horário!', 'type' => 'alert-danger']);
        }


        return view('schedule_create', ['message' => 'Horário agendado com sucesso!', 'type' => 'alert-success']);
    }

    public function toggleConfirm(Request $request, Schedule $schedule)
    {
        $schedule->confirm = !$schedule->confirm;
        $schedule->save();

        return redirect()->route('admin');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->back()->with('message', 'Agendamento cancelado com sucesso!');
    }
}
