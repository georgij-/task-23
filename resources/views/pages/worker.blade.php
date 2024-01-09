@extends('layouts.default')
@section('content')
<article style="margin-top: 0;">
    <header>
        <div class="grid">
            <h4 style="margin-bottom: 0;">{{ $worker->name }}</h4>
            <h4 style="margin-bottom: 0;">Average Pay: {{ $worker->averagePay() }}</h4>
            <h4 style="margin-bottom: 0;">Total Pay: {{ $worker->totalPay() }}</h4>
        </div>
    </header>
    <figure>
        <h4>Last 5 shifts:</h4>
        <table>
            <tr>
                <th>ID:</th>
                <th>Company:</th>
                <th>Hours:</th>
                <th>Rate:</th>
                <th>Total Pay:</th>
            </tr>
            @foreach ($worker->lastFive() as $shift)
            <tr>
                <td>{{ $shift->id }} </td>
                <td>{{ $shift->company }} </td>
                <td>{{ $shift->hours }} </td>
                <td>GBP {{ $shift->rate / 100 }} </td>
                <td>GBP {{ $shift->rate / 100 * $shift->hours }} </td>
            </tr>
            @endforeach
        </table>
    </figure>
</article>
@stop