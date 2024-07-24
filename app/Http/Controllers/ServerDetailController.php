<?php

namespace App\Http\Controllers;

use App\Cpu;
use App\Query;
use App\Hospital;
use App\BackupInfo;
use App\Console\Commands\CheckStatus;
use App\Events\ServerAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CpuResource;
use Illuminate\Support\Facades\Log;

class ServerDetailController extends Controller
{
    public function index()
    {
        return view('ServerDetail');
    }

    public function notif(){
        $pesan = [
            'name' => 'tejo',
            'pesan'=>'melebihi batas'
        ];

        event(new ServerAlert($pesan));
    }

    public function show(Request $request, $id)
    {
        // Find the hospital name by ID
        $hospital_name = Hospital::where('id', $id)->first()->nama_rs;
    
        // Get the latest CPU data for the hospital
        $data = DB::table('cpu as c')
                ->where('c.name', '=', $hospital_name)
                ->orderBy('c.created_at', 'desc')
                ->first();
    
        // Calculate memory and disk utilization
        $data->memory_utilization = round(($data->memory_in_use_mb / $data->total_memory_mb) * 100, 2);
        $data->disk_utilization = round(($data->data_size / $data->disk_size) * 100, 2);
    
        // Convert data to object and then to array
        $datad = (object) $data;
        $dataj = json_encode($datad);
        $datas = json_decode($dataj, true);
    
        // Get related queries
        $queries = Query::where('name', $data->name)->get();
    
        // Add a custom ID to the queries
        foreach ($queries as $key => $value) {
            $queries[$key]['no'] = $key + 1;
        }
    
        // Get backup information
        $backup = BackupInfo::where('name', $data->name)->get();
    
        // Add a custom ID to the backups
        foreach ($backup as $key => $value) {
            $backup[$key]['no'] = $key + 1;
        }
    
        // If the request is AJAX, return JSON data
        if ($request->ajax()) {
            return response()->json([
                'data' => $datas,
                'queries' => $queries,
                'backup' => $backup
            ]);
        }
    
        // Return the view for non-AJAX requests
        return view('serverDetail')->with('data', $datas)->with('queries', $queries)->with('backup', $backup);
    }
}