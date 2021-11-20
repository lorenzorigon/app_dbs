@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Agenda do Dia
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
                        <div class="col-6 align-self-center">
                            <form action="{{route('toggleConfirm', ['schedule' => $schedule])}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn {{ $schedule->confirmed ? 'btn-success' : 'btn-danger' }} btn-md">
                                    {{ $schedule->confirmed ? 'Confirmado' : 'Confirmar' }}
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection
