@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Bem vindo {{auth()->user()->name}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="container mt-4 mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <a href="schedule/create">
                                        <button class="btn btn-success text-white" type="submit">
                                            Agendar Horário
                                        </button>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="schedule">
                                        <button class="btn btn-primary text-white" type="submit">
                                            Meus agendamentos
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-1 mb-1">
                            <h5 class="text-center">Cartão Fidelidade</h5>
                            <div class="justify-content-center row gap-1">
                                @for($i = 1; $i <= 10; $i++)
                                    <div class="col-2" style="border: 1px solid black;height: 40px;)">
                                        @if(auth()->user()->loyalty >= $i)
                                            <img class="mt-1" src="img/logo.svg" alt="" style="width:30px">
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <hr>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <p><b>Barba:</b> 20,00</p>
                                </div>
                                <div class="col-12">
                                    <p><b>Corte Social:</b> 20,00</p>
                                </div>
                                <div class="col-12">
                                    <p><b>Corte Degradê:</b> 30,00</p>
                                </div>
                                <div class="col-12">
                                    <p><b>Desenho c/ Navalha:</b> 10,00</p>
                                </div>
                                <div class="col-12">
                                    <p><b>Desenho c/ Pigmentação:</b> 5,00</p>
                                </div>
                                <div class="col-12">
                                    <p><b>Combo 2 Social + 4 Barbas:</b> 90,00</p>
                                </div>
                                <div class="col-12">
                                    <p><b>Combo 2 Degradê + 4 Barbas:</b> 110,00</p>
                                </div>
                            </div>
                            <img class="img-precos" src="img/logo.svg" alt="" style="width: 80px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
