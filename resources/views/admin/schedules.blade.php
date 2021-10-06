@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Agenda do Dia 
        </div>
        
        <!-- Area administrativa estatica (Implementar dinâmica)-->
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col align-self-center">
                        <p>
                            Horário: 14:00
                            Serviço: Corte
                            Cliente: Lorenzo
                        </p>
                    </div>
                    <div class="col align-self-center">
                        <button class="btn btn-success btn-md">
                            Confirmado
                        </button>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col align-self-center">
                        <p>
                            Horário: 14:30
                            Serviço: Corte
                            Cliente: Emiliano
                        </p>
                    </div>
                    <div class="col align-self-center">
                        <button class="btn btn-danger btn-md">
                            Confirmar
                        </button>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection