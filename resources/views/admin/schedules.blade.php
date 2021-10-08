@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Agenda do Dia
        </div>

        <!-- Area administrativa estatica (Implementar dinâmica)-->
        <div class="card-body">
            <div class="container">
                <div class="row">
                    @foreach ($schedules as $schedule)
                        <div class="col-6 align-self-center">
                            <p>
                                Horário: {{ $schedule->hour }} hrs
                                Serviço: {{ $schedule->service }}
                                Cliente: {{ $schedule->user->name }}
                            </p>
                        </div>
                        <div class="col-6 align-self-center">
                            <form action="{{route('schedule.update', ['schedule' => $schedule])}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn {{ $schedule->confirm ? 'btn-success' : 'btn-danger' }} btn-md">
                                    {{ $schedule->confirm ? 'Confirmado' : 'Confirmar' }}
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
