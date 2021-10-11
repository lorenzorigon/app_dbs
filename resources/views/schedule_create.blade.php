<?php
   use App\Models\Schedule;
?>
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

                        <!-- Mensagem de Sucesso-->
                        @if (session('message'))
                            <p class="alert {{session('type')}}">{{session('message')}}</p>
                        @endif

                        <!-- Mensagem de Validação de campos-->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }} <br>
                                    @endforeach
                            </div>
                        @endif
                        <form action="{{ route('schedule.store') }}" method="POST">
                            @csrf
                            <div class="container">
                                <div class="row text-center">

                                    <!-- Seleção de serviço -->
                                    <div class="row align-items-center mb-2 ml-3">
                                        <div class="form-check">
                                            <input id="corte" class="form-check-input" type="radio" name="service"
                                                value="{{Schedule::SERVICE_CORTE}}" checked>
                                            <label for="corte" class="form-check-label mr-2"> Corte </label>
                                        </div>
                                        <div class="form-check">
                                            <input id="barba" class="form-check-input" type="radio" name="service"
                                                value="{{Schedule::SERVICE_BARBA}}">
                                            <label for="barba" class="form-check-label mr-2"> Barba </label>
                                        </div>
                                        <div class="form-check">
                                            <input id="completo" class="form-check-input" type="radio" name="service"
                                                value="{{Schedule::SERVICE_COMPLETO}}">
                                            <label for="completo" class="form-check-label"> Corte & Barba </label>
                                        </div>
                                    </div>

                                    <!-- Campo de data -->

                                    <div class="col-12 mb-2">
                                        <input type="date" class="form-control" id="day" name="day"
                                            value="{{ date('Y-m-d') }}">
                                    </div>

                                    <!-- Botões de horário-->
                                    @for ($i = 13; $i < 20; $i++)
                                        <div class="col-6">
                                            <input id='{{ $i }}' type="radio" name="hour"
                                                value="{{ $i }}:00">
                                            <label for="{{ $i }}">{{ $i }}:00</label>
                                        </div>
                                        <div class="col-6">
                                            <input id='{{ $i * 2 }}' type="radio" name="hour"
                                                value="{{ $i }}:30">
                                            <label for='{{ $i * 2 }}'>{{ $i }}:30</label>
                                        </div>
                                    @endfor

                                    <!-- Botão para agendar horário -->
                                    <div class="col-12">
                                        <button class="btn btn-success mt-1" type="submit"
                                            style="width:100%;font-size:20px">Agendar</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
