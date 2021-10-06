@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agendar horário 
                    <select class="form-select-lg ml-4" id="service" style="float: right">
                        <option disabled selected>Serviço</option>
                        <option value="1">Corte</option>
                        <option value="2">Barba</option>
                      </select>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <div class="row text-center">
                            
                            <div class="col-12 mb-3">
                                <input type="date" class="form-control" id="date">
                            </div>


                            <div class="col-6">
                                <button class="btn btn-primary btn-lg mb-1">13:00</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg mb-1">13:30</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg mb-1">14:00</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg mb-1">14:30</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg mb-1">15:00</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg mb-1">15:30</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg mb-1">16:00</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg mb-1">16:30</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg mb-1">17:00</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg mb-1">17:30</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg mb-1">18:00</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg mb-1">18:30</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg mb-1">19:00</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg mb-1">19:30</button>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-success mt-2" style="width:100%;font-size:20px">Agendar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
