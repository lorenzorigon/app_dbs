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
                                    <form action="{{route('admin.dailySchedules')}}" method="get">
                                        <input type="hidden" name="date" value="{{date('Y-m-d')}}">
                                        @csrf
                                        <button class="btn btn-success text-white" type="submit">
                                            Agenda Diária
                                        </button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <a href="{{route('admin.expanses.create')}}">
                                        <button class="btn btn-success text-white" type="submit">
                                            Entrada / Saída
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <form action="{{route('admin.schedules.finish')}}" method="get">
                                        @csrf
                                        <input type="hidden" name="date" value="{{date('Y-m-d')}}">
                                        <button class="btn btn-primary text-white" type="submit">
                                            Finalizar Serviço
                                        </button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <a href="{{route('admin.expanses')}}">
                                        <button class="btn btn-primary text-white" type="submit">
                                            Relatório Financeiro
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

