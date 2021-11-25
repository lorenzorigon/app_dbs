<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FinishScheduleController extends Controller
{
    public function index(Request $request)
    {
        dd($request->all());
        //adicionar pagamento
        $this->addPayment($request->value);

    }

    private function addLoyalty(User $user)
    {

    }

    private function addPayment()
    {

    }
}
