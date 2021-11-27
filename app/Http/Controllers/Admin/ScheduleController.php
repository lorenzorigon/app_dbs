<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;


class ScheduleController extends Controller
{
    public function index(){
        return view ('admin.index');
    }

    public function dailySchedules(Request $request)
    {
        $schedules = Schedule::query()->where('done' ,'=', 0)->whereDate('start_at', $request->date)->with('user')->get();
        return view('admin.schedules.index', ['schedules' => $schedules, 'date' => $request->date]);
    }

    public function finish(Request $request){
        $schedules = Schedule::query()->where('done', '='    ,0)->where('confirmed', '=', 1)
            ->whereDate('start_at', '<=' ,$request->date)->with('user')->get();

        return view('admin.schedules.finish',['schedules' => $schedules, 'date' => $request->date]);
    }


    public function toggleConfirm(Schedule $schedule)
    {
        $schedule->confirmed = !$schedule->confirmed;
        $schedule->save();

        return redirect()->back();
    }
}
