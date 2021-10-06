@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Meus Agendamentos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                              <tr>
                                <th scope="col">Dia</th>
                                <th scope="col">Horário</th>
                                <th scope="col">Confirmado</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>10/10</td>
                                <td>14:00</td>
                                <td style="color: green; font-weight:bold"> V </td>
                              </tr>
                              <tr>
                                <td>20/10</td>
                                <td>17:30</td>
                                <td style="color: red; font-weight:bold"> X</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
