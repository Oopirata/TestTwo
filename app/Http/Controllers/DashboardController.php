<?php

namespace App\Http\Controllers;

use App\Events\ServerAlert;
use App\Http\Controllers\CheckStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
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
                        ISNULL(CONVERT(varchar, b.last_db_backup_date, 113), 'not available') AS last_db_backup_date,
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
    
        if ($request->ajax()) {
            return response()->json($data);
        }
    
        $datad = (object) $data;
        $summ = [
            'normal' => 0,
            'warning' => 0,
            'danger' => 0,
        ];
    
        foreach ($data as $value) {
            if (max($value->cpu_utilization, $value->memory_utilization, $value->disk_utilization) < 60) {
                $summ['normal']++;
            } elseif (max($value->cpu_utilization, $value->memory_utilization, $value->disk_utilization) < 80) {
                $summ['warning']++;
            } else {
                $summ['danger']++;
            }
        }
    
        return view('dashboard', compact('datad', 'summ'));
    }    

    public function notif(){
        $pesan = [
            'name' => 'tejo',
            'pesan'=>'melebihi batas'
        ];

        event(new ServerAlert($pesan));
    }
}
