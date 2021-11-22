<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expanse;
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
        return view ('admin.expanses.create');
    }


    public function store(Request $request)
    {
        Expanse::create($request->only('type', 'amount', 'description'));
        return redirect()->back()->with('message', 'Registro inserido com sucesso');
    }

    public function report(){
        return view ('admin.expanses.report');
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
