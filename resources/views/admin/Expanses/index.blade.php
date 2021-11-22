@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('message'))
            <p class="alert alert-success">{{session('message')}}</p>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="col-12 mb-1">
                    <label for="date">Data inicial: </label>
                    <input type="date" class="form-control" id="date" name="start_date" min="{{ date('Y-m-d') }}"
                           value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-12 mb-4">
                    <label for="date">Data final:</label>
                    <input type="date" class="form-control" id="day" name="final_date" min="{{ date('Y-m-d') }}"
                           value="{{ date('Y-m-d') }}">
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Valor</th>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expanses as $expanse)
                        @php
                            $expanseDate = \Carbon\Carbon::create($expanse->created_at);
                        @endphp
                        <tr>
                            <td>{{$expanse->amount}}</td>
                            <td>{{$expanse->type ? 'Entrada' : 'Saída'}}</td>
                            <td>{{$expanseDate->format('d/m')}}</td>
                            <td>
                                <form id="form_{{$expanse['id']}}"
                                      action="{{route('admin.expanses.destroy', ['expanse' => $expanse['id']])}}"
                                      method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="#"
                                       onclick="document.getElementById('form_{{$expanse['id']}}').submit()"><img
                                            src="/img/trash.svg" style="width: 20px"></a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{route('admin.expanses.report')}}" class="btn btn-primary float-left text-white">Relatório</a>
            </div>
        </div>
    </div>
@endsection
