@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Agenda do Dia
        </div>

        <div class="card-body">
            <div class="container">
                <div class="row">
                    <a href="" class="btn btn-success  offset-1 col-5">Entrada</a>
                    <a href="" class="btn btn-danger col-5 ml-1">Saída</a>

                    <!-- formularios para adicionar entrada ou saída R$ -->
                    <div id="income" class="mt-4" style="display: none">
                        <form action="">
                            <div class="form-group">
                                <label for="income">Entrada</label>
                                <input class="form-control" type="text">
                            </div>
                        </form>
                    </div>
                    <div id="outcome" class="mt-4" style="display: none">
                        <form action="">
                            <div class="form-group">
                                <label for="outcome">Saída</label>
                                <input class="form-control" type="text">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
