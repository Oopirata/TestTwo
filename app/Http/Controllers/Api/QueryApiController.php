<?php

namespace App\Http\Controllers\Api;


use App\Query;
use App\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class QueryApiController extends Controller
{
    //

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
            $queryLog = new Query();
            $queryLog->name = $data['name'];
            $queryLog->server = $data['server'];
            $queryLog->query = $record['Query'];
            $queryLog->count = $record['Count'];
            $queryLog->last_query = $record['Time'];
            
            // Save the record to the database
            $queryLog->save();
        }
        
    
        return response()->json([
            'status' => 'success',
            'message' => 'Data has been saved',
            'data' => $data
        ]);
    }

    


}
