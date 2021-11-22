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

    public function dailySchedules()
    {
        $schedules = Schedule::query()->whereDate('start_at', date('Y-m-d'))->with('user')->get();
        return view('admin.schedules.index', ['schedules' => $schedules]);
    }


    public function toggleConfirm(Schedule $schedule)
    {
        $schedule->confirmed = !$schedule->confirmed;
        $schedule->save();

        return redirect()->back();
    }
}
