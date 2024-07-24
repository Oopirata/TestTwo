<?php

namespace App\Http\Controllers\Api;

use App\Hospital;
use App\BackupInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackupApiController extends Controller
{
    //
    public function index()
    {
        $backupLogs = BackupInfo::all();
        dd($backupLogs);
        return response()->json($backupLogs);
    }



    public function store(Request $request)
    {

        $data = $request->all();

        
        
        
        if(Hospital::where('nama_rs', $data['name'])->count() == 0){
            $hospital = new Hospital();
            $hospital->nama_rs = $data['name'];
            $hospital->nama_server = $data['server'];
            $hospital->save();
        } 
        
        
        foreach ($data as $key => $record) {
            
            if (!is_numeric($key)) {
                continue;
            }
            
            // Create a new QueryLog instance
            $backupLog = new BackupInfo();
            $backupLog->name = $data['name'];
            
            $backupLog->server = $data['server'];
            $backupLog->database_name = $record['database_name'];
            $backupLog->last_db_backup_date = $record['last_db_backup_date'];
            // return response()->json([
            //     'status' => 'success',
            //     'message' => 'Data has been saved',
            //     'data' => $record['last_db_backup_date']
            // ]);
            $backupLog->backup_start_date = $record['backup_start_date'];
            $backupLog->backup_size = $record['backup_size'];
            $backupLog->physical_device_name = $record['physical_device_name'];
            $backupLog->backupset_name = $record['backupset_name'];
            
            // Save the record to the database
            $backupLog->save();
        }
        
    
        return response()->json([
            'status' => 'success',
            'message' => 'Data has been saved',
            'data' => $data
        ]);


    }



}
