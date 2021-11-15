<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;


class ScheduleController extends Controller
{
    public function dailySchedules()
    {
        $schedules = Schedule::query()->whereDate('start_at', date('Y-m-d'))->with('user')->get();
        return view('admin.schedules', ['schedules' => $schedules]);
    }

    public function expanses()
    {
        return view ('admin.expanses');
    }

    public function toggleConfirm(Request $request, Schedule $schedule)
    {
        $schedule->confirmed = !$schedule->confirmed;
        $schedule->save();

        return redirect()->route('admin');
    }
}
