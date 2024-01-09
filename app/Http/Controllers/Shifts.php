<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Worker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Models\Shift;

class Shifts extends Controller
{

    public function create(Request $request) : RedirectResponse {

        
        $validated = $request->validate([
            'worker_id' => 'required|numeric|exists:workers,id',
            'shift_type' => 'required',
            'company' => 'required',
            'hours' => 'required|numeric',
            'rate' => 'required|numeric',
            'taxable' => 'required|boolean',
            'status' => 'required',
        ]);
        
        $data = $request->all();

        $model = new Shift;

        $model->created_at = Carbon::now();

        $model->worker_id = $data['worker_id'];
        $model->shift_type = $data['shift_type'];
        $model->company = $data['company'];
        $model->hours = $data['hours'];
        $model->rate = (int) (filter_var($data['rate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) * 100);
        $model->status = $data['status'];
        $model->taxable = $data['taxable'];

        $model->save();

        return redirect()->route('edit', ['id' => $model->id]);
    }

    public function update(Request $request, string $id)
    {   
        $model = Shift::findOrFail($id);

        $validated = $request->validate([
            'worker_id' => 'required|numeric|exists:workers,id',
            'shift_type' => 'required',
            'company' => 'required',
            'hours' => 'required|numeric',
            'rate' => 'required|numeric',
            'taxable' => 'required|boolean',
            'status' => 'required',
        ]);
        
        $data = $request->all();

        $model->worker_id = $data['worker_id'];
        $model->shift_type = $data['shift_type'];
        $model->company = $data['company'];
        $model->hours = $data['hours'];
        $model->rate = (int) (filter_var($data['rate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) * 100);
        $model->status = $data['status'];
        $model->taxable = $data['taxable'];

        $model->save();

        return redirect('/');
    }

    public function delete(string $id) : RedirectResponse {
        $model = Shift::findOrFail($id);
        $model->delete();

        return redirect()->back();
    }
    

    public function import(Request $request)
    {
        $file = $request->file('file');
        $data = $this->csvToArray($file->getPathName());

        foreach (array_chunk($data,1000) as $shift)  
        {
            DB::table('shifts')->insert($shift); 
        }

        return redirect('/');
    }

    protected function csvToArray($filename, $delimiter = ',')
    {
        if(!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header)
                {
                    $header = array('created_at','worker_id', 'company', 'hours', 'rate', 'taxable', 'status', 'shift_type', 'paid_at');
                }
                else
                {   
                    $row[0] = Carbon::createFromFormat('Y-m-d', $row[0])->toDateTimeString();

                    if($row[1]) {
                        $worker = Worker::where('name', $row[1])->first();
                        if($worker) {
                            $row[1] = $worker->id;
                        } else {
                            $createdWorker = Worker::create([
                                'name' => $row[1]
                            ]);

                            $row[1] = $createdWorker->id;
                        }
                    }
                    
                    $row[4] = (int) (filter_var($row[4], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) * 100);
                    
                    $row[5] = $row[5] == "Yes" ? true : false;

                    if($row[8] != "") {
                        $row[8] = $row[8] = Carbon::createFromFormat('Y-m-d H:i:s', $row[8])->toDateTimeString();
                    } else {
                        $row[8] = NULL;
                    }

                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }
}
