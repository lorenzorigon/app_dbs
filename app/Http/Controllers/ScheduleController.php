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
        $schedules = Schedule::where('user_id', auth()->user()->id)->where('end_at', '>=' ,Carbon::now())->get();
        return view('myschedules', ['schedules' => $schedules]);
    }


    public function getAppointments(Request $request)
    {
        $day = $request->get('day');
        $service = $request->get('service');
        $listAppointmentService = new ListAppointmentService();
        return response()->json($listAppointmentService->list($day, $service, auth()->user()));
    }

    public function create()
    {
        $users = User::all();
        return view('schedule_create', ['users' => $users]);
    }


    public function store(Request $request)
    {
        $request->validate(Schedule::rules(), Schedule::feedback());
        $scheduleData = $request->only('start_at_day', 'start_at_hour', 'service');

        if($request->user){
            $user = User::query()->find($request->user);
        }else{
            $user = auth()->user();
        }


        $schedulingService = new StoreScheduleService();
        try {
            $schedulingService->store($user, $scheduleData['start_at_day'], $scheduleData['start_at_hour'], $scheduleData['service']);
        } catch (UnprocessableEntityHttpException) {
            return redirect()->back()->with('message', 'Horário já está agendado!')->with('type', 'alert-danger');
        }


        return redirect()->back()->with('message', 'Horário marcado com sucesso!')->with('type', 'alert-success');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->back()->with('message', 'Agendamento cancelado com sucesso!');
    }
}
