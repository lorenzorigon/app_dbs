<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Services\Schedule\ListScheduleOptions\ListAppointmentService;
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
        $schedules = Schedule::query()->whereDate('start_at', date('Y-m-d'))->with('user')->get();
        return view('admin.schedules', ['schedules' => $schedules]);
    }

    public function getAppointments(Request $request){
        $day = $request->get('day');
        $service = $request->get('service');
        $listAppointmentService = new ListAppointmentService();
        return response()->json($listAppointmentService->list($day, $service, User::query()->first()));
    }

    public function create()
    {
        /*$options = new ListAppointmentService();
        $options->listOptions();*/

        return view('schedule_create');
    }

    public function store(Request $request)
    {
        $request->validate(Schedule::rules(), Schedule::feedback());
        $scheduleData = $request->only('start_at_day', 'start_at_hour', 'service');

        $schedulingService = new StoreScheduleService();
        try{
            $schedulingService->store(auth()->user(), $scheduleData['start_at_day'], $scheduleData['start_at_hour'], $scheduleData['service']);
        }catch (UnprocessableEntityHttpException){
            return redirect()->back()->with('message', 'Horário já está agendado!')->with('type', 'alert-danger');
        }


        return redirect()->back()->with('message', 'Horário marcado com sucesso!')->with('type', 'alert-success');
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
