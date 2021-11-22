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
                                    <a href="{{route('admin.dailySchedules')}}">
                                        <button class="btn btn-success text-white" type="submit">
                                            Agenda Diária
                                        </button>
                                    </a>
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
                                <div class="offset-3 col-6">
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
