<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expanse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ExpanseController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->start_date;
        $final_date = $request->final_date;

        $expanses = Expanse::whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->final_date . ' 23:59:59'])->get();

        $balance = $this->calcBalance($expanses);

        return view('admin.expanses.index', ['expanses' => $expanses, 'start_date' => $start_date, 'final_date' => $final_date, 'balance' => $balance]);
    }

    public function create()
    {
        return view('admin.expanses.create');
    }


    public function store(Request $request)
    {
        Expanse::create($request->only('type', 'amount', 'description'));
        return redirect()->back()->with('message', 'Registro inserido com sucesso');
    }

    public function reportPDF(Request $request)
    {
        //definindo dia e mes da data inicial e data final
        $start_date = Carbon::create($request->start_date)->format('d/m');
        $final_date = Carbon::create($request->final_date)->format('d/m');

        //pesquisando os gatos dentro do range de filtro
        $expanses = Expanse::whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->final_date . ' 23:59:59'])->get();

        //calcular saldo
        $balance = $this->calcBalance($expanses);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('admin.Expanses.report', ['expanses' => $expanses, 'balance' => $balance, 'start_date' => $start_date, 'final_date' => $final_date]);
        return $pdf->download('VendaX.pdf');
    }

    public function destroy($id)
    {
        Expanse::destroy($id);
        return redirect()->back()->with('message', 'Movimentação deletada com sucesso!');
    }

    private function calcBalance($expanses)
    {
        $balance = 0;
        foreach ($expanses as $expanse) {
            if($expanse->type == 0){
                $balance -= $expanse->amount;
            }else{
                $balance += $expanse->amount;
            }

        }

        return $balance;
    }
}
