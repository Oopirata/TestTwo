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
                            MAX(created_at) AS latest_created_at
                        FROM
                            cpu
                        GROUP BY
                            name
                    )
                    SELECT 
                        r.id AS id,
                        r.nama_rs AS name,
                        r.nama_server AS server,
                        -- IFNULL(MAX(b.last_db_backup_date),'1010-10-10 10:10:10') AS last_db_backup_date,
                        ISNULL(CONVERT(varchar, created_at, 113), 'not available') AS last_db_backup_date,
                        c.cpu_utilization,
                        c.cpu_sql_util,
                        ROUND((c.memory_in_use_mb/ c.total_memory_mb)*100,2) as memory_utilization,
                        ROUND((c.data_size/ c.disk_size)*100,2) as disk_utilization,
                        c.total_memory_mb,
                        c.memory_in_use_mb,
                        c.sql_memory_mb,
                        c.disk_size,
                        c.data_size,
                        c.used_data_size
                    FROM 
                        rsname r
                    LEFT JOIN 
                        backup_info b 
                    ON 
                        r.nama_rs = b.name
                    LEFT JOIN 
                        cpu c 
                    ON 
                        r.nama_rs = c.name
                    AND 
                        c.created_at = (
                            SELECT 
                                l.latest_created_at
                            FROM 
                                LatestCPU l
                            WHERE 
                                l.name = r.nama_rs
                        )
                    GROUP BY 
                        r.nama_rs, c.cpu_utilization, c.cpu_sql_util, c.total_memory_mb, c.memory_in_use_mb, c.sql_memory_mb, c.disk_size, c.data_size, c.used_data_size;";
    
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
