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

                        @if (session('message'))
                            <p class="alert alert-success">{{session('message')}}</p>
                        @endif

                        @if($schedules->isEmpty())
                            <p>Você ainda não possui horário marcado,
                                <a href="{{route('schedule.create')}}">agendar horário</a>.
                            </p>
                        @endif

                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Dia</th>
                                    <th scope="col">Horário</th>
                                    <th scope="col">Confirmado</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($schedules as $schedule)
                                    @php
                                        $scheduleDate = \Carbon\Carbon::create($schedule->start_at);
                                    @endphp
                                    <tr>
                                        <td>{{$scheduleDate->format('d/m')}}</td>
                                        <td>{{ $scheduleDate->format('H:i') }}</td>
                                        <td
                                            style="color: {{ $schedule->confirm == 1 ? 'green' : 'red' }}; font-weight:bold">
                                            {{ $schedule->confirm == 1 ? 'V' : 'X' }}
                                        </td>
                                        <td>
                                            <form id="form_{{$schedule['id']}}"
                                                  action="{{route('schedule.destroy', ['schedule' => $schedule['id']])}}"
                                                  method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <a href="#"
                                                   onclick="document.getElementById('form_{{$schedule['id']}}').submit()"><img
                                                        src="/img/trash.svg" style="width: 20px"></a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
