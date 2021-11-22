<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expanse;
use Illuminate\Http\Request;

class ExpanseController extends Controller
{

    public function index()
    {

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


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
