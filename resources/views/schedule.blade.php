@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agendar horário</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <div class="row text-center">
                            <form action="">
                                <!-- Seleção de serviço -->
                                <div class="row align-items-center mb-2 ml-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="service" id="corte">
                                        <label class="form-check-label mr-2" for="corte"> Corte </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="service" id="barba" checked>
                                        <label class="form-check-label" for="barba"> Barba </label>
                                    </div>
                                </div>
                            
                                <!-- Campo de data -->
                                <div class="col-12 mb-2">
                                    <input type="date" class="form-control" id="date">
                                </div>

                                <!-- Botões de horário-->
                                @for ( $i = 13; $i < 20; $i++)
                                    <div class="col-6">
                                        <button class="btn btn-primary btn-lg mb-1">{{$i}}:00</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-primary btn-lg mb-1">{{$i}}:30</button>
                                    </div>
                                @endfor
                        
                                <!-- Botão para agendar horário -->
                                <div class="col-12">
                                    <button class="btn btn-success mt-1" style="width:100%;font-size:20px">Agendar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
