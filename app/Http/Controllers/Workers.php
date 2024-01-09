<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Workers extends Controller
{
    //

    public function show(string $id) : View {
        return view('pages.worker', [
            'worker' => Worker::findOrFail($id)
        ]);
    }
}
