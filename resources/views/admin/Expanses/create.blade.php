@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Agenda do Dia
        </div>

        <div class="card-body">
            <div class="container">
                <div class="row">

                    @if(session('message'))
                        <p class="alert alert-success">{{session('message')}}</p>
                    @endif

                    <!-- formularios para adicionar entrada ou saída R$ -->
                    <div id="income" class="col-12 mt-4">
                        <form action="{{route('admin.expanses.store')}}" method="post">
                            @csrf
                            <div class="form-group mb-1">
                                <select class="form-select" name="type" id="type">
                                    <option value="1">Entrada</option>
                                    <option value="0">Saída</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Valor</label>
                                <input class="form-control" name="amount" type="number">
                            </div>
                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <input class="form-control" name="description" type="text">
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-success">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
