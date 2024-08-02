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
use Illuminate\Support\Carbon;

class CpuController extends Controller
{
    public function index()
    {

        //get all latest cpu data base on name in rsname table

        $mainquery = "WITH LatestCPU AS (
                        SELECT
                            name,
                            cpu_utilization,
                            cpu_sql_util,
                            memory_in_use_mb,
                            total_memory_mb,
                            sql_memory_mb,
                            disk_size,
                            data_size,
                            used_data_size,
                            ROW_NUMBER() OVER (PARTITION BY name ORDER BY created_at DESC) AS rn
                        FROM
                            cpu
                    ),
                    LatestBackupInfo AS (
                        SELECT
                            name,
                            last_db_backup_date,
                            ROW_NUMBER() OVER (PARTITION BY name ORDER BY created_at DESC) AS rn
                        FROM
                            backup_info
                    )

                    SELECT 
                        r.id AS id,
                        r.nama_rs AS name,
                        r.nama_server AS server,
                        ISNULL(CONVERT(varchar, b.last_db_backup_date, 121), 'not available') AS last_db_backup_date,
                        c.cpu_utilization,
                        c.cpu_sql_util,
                        ROUND(((c.memory_in_use_mb + 0.0) / (c.total_memory_mb + 0.0) * 100), 2) AS memory_utilization,
                        ROUND(((c.data_size + 0.0) / (c.disk_size + 0.0) * 100), 2) AS disk_utilization,
                        c.total_memory_mb,
                        c.memory_in_use_mb,
                        c.sql_memory_mb,
                        c.disk_size,
                        c.data_size,
                        c.used_data_size
                    FROM 
                        rsname r
                    LEFT JOIN 
                        LatestBackupInfo b 
                    ON 
                        r.nama_rs = b.name AND b.rn = 1
                    LEFT JOIN 
                        LatestCPU c 
                    ON 
                        r.nama_rs = c.name AND c.rn = 1";


        $data = DB::select($mainquery);
        // $datas = (object) $data;

        // dd($data);
        // $data = $data->map(function ($item) {
        //     $item->memory_utilization = round(($item->memory_in_use_mb / $item->total_memory_mb) * 100, 2);
        //     $item->disk_utilization = round(($item->data_size / $item->disk_size) * 100, 2);
        //     $item->status = max($item->cpu_utilization, $item->memory_utilization, $item->disk_utilization) < 60 ? 'normal' : (max($item->cpu_utilization, $item->memory_utilization, $item->disk_utilization) < 80 ? 'warning' : 'danger');
        //     return $item;
        // });


        // $backupquery = "SELECT 
        //                     r.id,
        //                     r.nama_rs AS name,
        //                     IFNULL(MAX(b.last_db_backup_date),'0000-00-00 00:00:00') AS last_db_backup_date
        //                 FROM 
        //                     rsname r
        //                 LEFT JOIN 
        //                     backup_info b 
        //                 ON 
        //                     r.nama_rs = b.name
        //                 GROUP BY
        //                     r.nama_rs;";

        // $lastBackup = DB::select($backupquery);
        // $lastBackup = (object) $lastBackup;

        // $data = 

        $datad = (object) $data;

        // dd($datad);
        
        // dd($datad);
        // dd($data);

        // dd($lastBackup);
        // dd($summ);

          
        $summ = [];

        $summ['normal'] = 0;
        $summ['warning'] = 0;
        $summ['danger'] = 0;

        // $datad->last_db_backup_date = date_format(date_create($datad->last_db_backup_date),"H:i:s d-m-y");




        foreach ($data as $key => $value) {
            if (max($value->cpu_utilization, $value->memory_utilization, $value->disk_utilization) < 60) {
                $summ['normal']++;
            } elseif (max($value->cpu_utilization, $value->memory_utilization, $value->disk_utilization) < 80) {
                $summ['warning']++;
            } else {
                $summ['danger']++;
            }
        }

        

        return view('dashboard')->with('data', $datad)->with('summ', $summ);
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
    
        // Get related queries order by count and today and limit 10 and group by name query
        $queries = Query::select(DB::raw('CONVERT(VARCHAR(MAX), query) AS query'), DB::raw('SUM(count) as count'), DB::raw('MAX(last_query) as last_query'))
                    ->where('name', $hospital_name)
                    ->whereNotNull('query')
                    ->whereDate('created_at', date('Y-m-d'))
                    ->groupBy(DB::raw('CONVERT(VARCHAR(MAX), query)'))
                    ->orderBy('count', 'desc')
                    ->take(10)
                    ->get();

                    // dd($queries);

        // Add a custom ID to the queries
        foreach ($queries as $key => $value) {
            $queries[$key]['no'] = $key + 1;
        }
    
        // Get backup information order by latest last_db_backup_date and limit 10
        $backup = BackupInfo::where('name', $data->name)->orderBy('last_db_backup_date', 'desc')->take(10)->get();
    
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
        return view('serverDetail')->with('data', $datas)->with('queries', $queries)->with('backup', $backup)->with('identifier', $id);
    }    

    public function graph(Request $request, $id){


        // Get the hospital name
        $hospital_name = Hospital::where('id', $id)->first()->nama_rs;

        
        // Define the start and end time for the day
        $startOfDay = Carbon::today()->startOfDay();
        $endOfDay = Carbon::today()->endOfDay();

        $hourlyData = DB::table('cpu as c')
            ->select(
                DB::raw('DATEPART(hour,c.created_at) as hour'),
                DB::raw('AVG((c.memory_in_use_mb + 0.0) / c.total_memory_mb * 100) as avg_memory_utilization'),
                DB::raw('AVG((c.data_size + 0.0) / c.disk_size * 100) as avg_disk_utilization'),
                DB::raw('AVG(c.cpu_utilization) as avg_cpu_utilization')
            )
            ->where('c.name', '=', $hospital_name)
            ->whereBetween('c.created_at', [$startOfDay, $endOfDay])
            ->groupBy(DB::raw('DATEPART(hour,c.created_at)'))
            ->orderBy(DB::raw('DATEPART(hour,c.created_at)'))
            ->get();

        // Add data formatting if needed
        foreach ($hourlyData as $data) {
            $data->avg_memory_utilization = round($data->avg_memory_utilization, 2);
            $data->avg_disk_utilization = round($data->avg_disk_utilization, 2);
            $data->avg_cpu_utilization = round($data->avg_cpu_utilization, 2);
        }
        
        //separate them
        $cpuavg = [];
        $memoryavg = [];
        $diskavg = [];

        foreach ($hourlyData as $data) {
            $cpuavg[] = $data->avg_cpu_utilization;
            $memoryavg[] = $data->avg_memory_utilization;
            $diskavg[] = $data->avg_disk_utilization;
        }





        // If the request is AJAX, return JSON data
        if ($request->ajax()) {
            return response()->json([
                'hourlyData' => $hourlyData,
                'cpuavg' => $cpuavg,
                'memoryavg' => $memoryavg,
                'diskavg' => $diskavg
            ]);
        }





    }
}
