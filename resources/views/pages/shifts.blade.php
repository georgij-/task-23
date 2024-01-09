@extends('layouts.default')
@section('content')

<article style="margin-top: 0;">
    <header>
        <form style="margin-bottom: 0;">
            <div class="grid">
                <input type="number" id="nunber" name="number" placeholder="Shifts" value="" required>
                <button type="submit">Submit</button>
            </div>
        </form>
    </header>
    <figure>
        <table class="">
            <tr>
                <th class="py-4">ID:</th>
                <th class="py-4">Company:</th>
                <th class="py-4">Hours:</th>
                <th class="py-4">Rate:</th>
                <th class="py-4">Total Pay:</th>
                <th class="py-4"></th>
                <th class="py-4"></th>

            </tr>
        @foreach ($shifts as $shift)
            <tr>
                <td class="py-2">{{ $shift->id }} </td>
                <td>{{ $shift->company }} </td>
                <td>{{ $shift->hours }} </td>
                <td>GBP {{ $shift->rate / 100 }} </td>
                <td>{{ $shift->hours * ($shift->rate / 100) }}</td>
                <td><a href="/edit/{{ $shift->id }}">Edit</a></td>
                <td><a href="/delete/{{ $shift->id }}">Delete</a></td>
            </tr>
        @endforeach
        </table>
    </figure>

</article>

{{ $shifts->withQueryString()->links() }}

@stop