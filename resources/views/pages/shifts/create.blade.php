@extends('layouts.default')
@section('content')
<article style="margin-top: 0;">
    <header>
        <h2 style="margin-bottom: 0;">Create a new shift</h2>
    </header>
    <form method="post">
        @csrf

        <div class="grid">
            <label for="worker_id">
                Worker
                <select name="worker_id" id="worker_id">
                    @foreach ($workers as $worker)
                        @if ($loop->first)
                        <option value="{{ $worker->id }}" selected>{{ $worker->name }}</option>
                        @else
                        <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                        @endif
                    @endforeach
                </select>            
            </label>
            <label for="company">
                Company
                <input type="text" id="company" name="company" placeholder="Company" vrequired>
            </label>
        </div>

        <div class="grid">
            <label for="shift_type">
                Shift Type
                <select name="shift_type" id="shift_type">
                    @foreach ($shift_types as $type)
                        @if ($loop->first)
                        <option value="{{ $type }}" selected>{{ $type }}</option>
                        @else
                        <option value="{{ $type }}">{{ $type }}</option>
                        @endif
                    @endforeach
                </select>  
            </label>
            <label for="status">
                Status
                <select name="status" id="status">
                    @foreach ($statuses as $status)
                        @if ($loop->first)
                        <option value="{{ $status }}" selected>{{ $status }}</option>
                        @else
                        <option value="{{ $status }}">{{ $status }}</option>
                        @endif
                    @endforeach
                </select>  
            </label>
            <label for="taxable">
                Taxable
                <select name="taxable" id="taxable">
                    <option value="1" selected>True</option>
                    <option value="0">False</option>   
                </select>  
            </label>
        </div>

        <div class="grid">
            <label for="hours">
                Hours
                <input type="text" id="hours" name="hours" placeholder="Hours" required>
            </label>

            <label for="rate">
                Rate
                <input type="text" id="rate" name="rate" placeholder="Rate" required>
            </label>
        </div>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit">Submit</button>
    </form>
</article>
@stop