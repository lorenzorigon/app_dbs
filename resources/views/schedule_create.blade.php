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

                                <div class="row justify-content-around">

                                    <!-- Seleção de serviço -->
                                    <div class="col-12 mb-2 ml-3">
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
                                        <input type="date" class="form-control" id="day" name="start_at_day" min="{{ date('Y-m-d') }}"
                                            value="{{ date('Y-m-d') }}">
                                    </div>

                                    <div id="appointment-button-model" class="col-6 mb-1 radio-checkbox" style="display: none;">
                                        <input type="radio" name="start_at_hour">
                                        <label for="" class="label"></label>
                                    </div>

                                    <div id="appointments-wrapper" class="row"></div>

                                    <div id="loading" class="justify-content-center w-100" style="display: none;">
                                        <div class="spinner-border text-primary" role="status">
                                        </div>
                                    </div>

                                    <!-- Botão para agendar horário -->
                                    <div class="col-12" id="submit">
                                        <button class="btn btn-success mt-1" type="submit"
                                            style="width:100%;font-size:20px">Agendar</button>
                                    </div>
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

<script src="{{ asset('js/schedules/create.js') }}" defer></script>
