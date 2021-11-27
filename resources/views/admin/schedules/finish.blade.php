@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('admin.schedules.finish')}}" method="get">
                @csrf
                <input type="date" class="form-control" id="day" name="date" min="{{ date('Y-m-d') }}"
                       value="{{$date ? $date : Carbon::now() }}">
                <button class="mt-2 mb-2 btn btn-primary float-end">Buscar</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Serviços
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
                            <form action="{{route('admin.schedules.finishSchedule', ['id' => $schedule->id])}}" method="post">
                                @csrf
                                <div class="row flex-column">
                                    <label class="col" for="value">Valor</label>
                                    <input class="col-6" type="number" name="value" value="0">
                                    <button class="col-6  btn btn-success mt-1">Finalizar</button>
                                </div>
                            </form>
                        </div>
                    @endforeach

                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection
