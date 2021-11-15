@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Agenda do Dia
        </div>

        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-grid gap-2">
                        <a href="" class="btn btn-success">Entrada</a>
                        <a href="" class="btn btn-danger">Saída</a>
                    </div>

                    <!-- formularios para adicionar entrada ou saída R$ -->
                    <div id="income" class="col-12 mt-4">
                        <form action="">
                            <div class="form-group">
                                <label for="income">Entrada</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label for="description">Descrição</label>
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
