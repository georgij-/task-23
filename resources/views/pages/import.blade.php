@extends('layouts.default')
@section('content')
<article style="margin-top: 0;">
    <form style="margin-bottom: 0;" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".csv">
        <button type="submit">Import CSV</button>
    </form>
</article>
@stop