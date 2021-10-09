<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::where('user_id', auth()->user()->id)->get();
        return view('myschedules', ['schedules' => $schedules]);
    }

    public function dailySchedules(){
        $schedules = Schedule::where('day', date('Y-m-d'))->with('user')->get();
        return view('admin.schedules', ['schedules' => $schedules]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('schedule', ['message' => '']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Schedule::rules(), Schedule::feedback());
        $schedule = $request->only(['day', 'hour', 'service', '_token']);
        $schedule['user_id'] = auth()->user()->id;
        $schedule = Schedule::create($schedule);
        return view('schedule', ['message' => 'Horário agendado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);
        return $schedule;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $schedule = Schedule::find($id);
        if($schedule['confirm'] == 0){
            $schedule['confirm'] = 1;
        }else{
            $schedule['confirm'] = 0;
        }
        $schedule->save();

        return redirect()->route('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        $schedule->delete();
        return redirect()->route('schedule.index');
    }
}
