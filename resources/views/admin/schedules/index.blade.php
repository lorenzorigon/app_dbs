@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header row">
            <p class="col-5">Agenda do Dia</p>
            <input type="date" class="col form-control" id="day" name="start_at_day" min="{{ date('Y-m-d') }}"
                                 value="{{ date('Y-m-d') }}">
        </div>

        <div class="card-body">
            <div class="container">
                <div class="row">
                    @foreach ($schedules as $schedule)
                        @php
                            $scheduleDate = \Carbon\Carbon::create($schedule->start_at);
                        @endphp

                        <div class="col-6 align-self-center">
                            <p>
                                Horário: {{ $scheduleDate->format('H:i') }} hrs
                                Serviço: {{ \App\Models\Schedule::SERVICE_NAMES[$schedule->service] }}
                                Cliente: {{ $schedule->user->name }}
                            </p>
                        </div>
                        <div class="col-6">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <form action="{{route('toggleConfirm', ['schedule' => $schedule])}}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="btn {{ $schedule->confirmed ? 'btn-success' : 'btn-danger' }} btn-md">
                                            {{ $schedule->confirmed ? 'Confirmado' : 'Confirmar' }}
                                        </button>
                                    </form>
                                </div>
                                <div class="col-4">
                                    <form id="form_{{$schedule['id']}}"
                                          action="{{route('schedule.destroy', ['schedule' => $schedule['id']])}}"
                                          method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <a href="#" class="ml-4"
                                           onclick="document.getElementById('form_{{$schedule['id']}}').submit()"><img
                                                src="/img/trash.svg" style="width: 30px"></a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection
