@extends('layouts.default')
@section('content')

<article style="margin-top: 0;">
    <header>
        <h2 style="margin-bottom: 0;">Workers</h2>
    </header>
    <figure>
        <table class="">
            <tr>
                <th class="py-4">ID:</th>
                <th class="py-4">Name:</th>
                <th></th>
            </tr>
        @foreach ($workers as $worker)
            <tr>
                <td class="py-2">{{ $worker->id }} </td>
                <td>{{ $worker->name }}</td>
                <td><a href="/workers/{{ $worker->id }}">View Worker</a></td>
            </tr>
        @endforeach
        </table>
    </figure>

</article>
@stop