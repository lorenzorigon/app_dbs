<?php

namespace App\Http\Controllers;

use App\Models\Expanse;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class FinishScheduleController extends Controller
{
    public function index(Request $request, $id)
    {
        $schedule = Schedule::query()->where('id', $id)->with('user')->first();

        $this->addLoyalty($schedule->user);

        $this->addPayment($request, $schedule->user->name);

        $schedule->done = 1;
        $schedule->save();

        return redirect()->back()->with('message', 'Serviço Finalizado!');
    }

    private function addLoyalty(User $user)
    {
        $user->loyalty += 1;
        $user->save();
    }

    private function addPayment($request, $user)
    {
        Expanse::create([
            'amount' => $request->value,
            'type' => 1,
            'description' => $user . ', pagamento corte.'
        ]);
    }
}
