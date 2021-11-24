<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movimentações</title>

    <style>
        #tt {
            font-size: 20px;
            background-color: #ccc;
        }

        .table {
            width: 100%;
        }

        table th {
            text-align: left;
        }
    </style>

</head>
<body>
<div style="text-align: center">
    <h1>Douglas Barber Shop </h1>
</div>


<div style="text-align: center">
    @if($start_date != $final_date)
        <h1 id="tt">Movimentações Financeiras de {{$start_date}} a {{$final_date}}</h1>
    @else
        <h1 id="tt">Movimentações Financeiras de {{$start_date}}</h1>
    @endif
</div>

<table class="table table-striped">
    <thead>
    <tr>
        <th>Valor</th>
        <th>Tipo</th>
        <th>Descrição</th>
        <th>Data</th>
    </tr>
    </thead>
    <tbody>
    @foreach($expanses as $expanse)
        @php
            $expanseDate = \Carbon\Carbon::create($expanse->created_at);
        @endphp
        <tr>
            <td style="color: {{$expanse->type ? 'green' : 'red'}}">{{$expanse->amount}}</td>
            <td>{{$expanse->type ? 'Entrada' : 'Saída'}}</td>
            <td>{{$expanse->description}}</td>
            <td>{{$expanseDate->format('d/m')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div style="text-align: right;margin-right: 20px">
    <h2 style="color: {{$balance >= 0 ? 'green' : 'red'}}">Saldo: {{$balance}}</h2>
</div>
</body>
</html>
