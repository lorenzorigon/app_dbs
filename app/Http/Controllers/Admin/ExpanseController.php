<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expanse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpanseController extends Controller
{

    public function index()
    {

        $expanses = Expanse::all();
        return view('admin.expanses.index', ['expanses' => $expanses]);
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

    public function filterExpanses(Request $request)
    {
        $start_date = $request->start_date;
        $final_date = $request->final_date;


        $expanses = Expanse::whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->final_date . ' 23:59:59'])->get();

        return view('admin.expanses.index', ['expanses' => $expanses, 'start_date' => $start_date, 'final_date' => $final_date]);
    }

    public function reportPDF(Request $request)
    {
        dd($request->all());
        $expanses = Expanse::whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->final_date . ' 23:59:59'])->get();
    }

    public function show($id)
    {
        //
    }


    public function destroy($id)
    {
        Expanse::destroy($id);
        return redirect()->back()->with('message', 'Movimentação deletada com sucesso!');
    }
}
