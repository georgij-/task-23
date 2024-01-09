<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Shifts as ShiftsController;
use App\Http\Controllers\Workers as WorkersController;
use App\Models\Worker;
use App\Models\Shift;
// use DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/import', function () {
    return view('pages.import');
});

Route::post('/import', [ShiftsController::class, 'import'])->name('import');

Route::get('/workers', function () {
    $data = Worker::all();

    return view('pages.workers', ['workers' => $data]);
});

Route::get('/workers/{id}', [WorkersController::class, 'show']);


Route::get('/', function () {
    $data = Shift::paginate(30);
    
    $request = request();
    if($request->input('number')) {
        $input = $request->input('number');
        
        $data = Shift::select("*", DB::raw('hours * rate / 100 as total'))
                    ->having('total', '>', $input)
                    ->orderBy('id')
                    ->paginate(30);
    }

    return view('pages.shifts', ['shifts' => $data]);
});

Route::get('/edit/{id}', function ($id) {
    $shift = Shift::findOrFail($id);
    $workers = Worker::all();
    $shift_types = Shift::all()->pluck('shift_type')->unique();
    $statuses = Shift::all()->pluck('status')->unique();
    return view('pages.shifts.edit', ['shift' => $shift, 'workers' => $workers, 'shift_types' => $shift_types, 'statuses' => $statuses]);
});
Route::post('/edit/{id}', [ShiftsController::class, 'update']);
Route::get('/delete/{id}', [ShiftsController::class, 'delete']);

Route::get('/create', function () {
    $workers = Worker::all();
    $shift_types = Shift::all()->pluck('shift_type')->unique();
    $statuses = Shift::all()->pluck('status')->unique();

    return view('pages.shifts.create', ['workers' => $workers, 'shift_types' => $shift_types, 'statuses' => $statuses]);
});
Route::post('/create', [ShiftsController::class, 'create']);
