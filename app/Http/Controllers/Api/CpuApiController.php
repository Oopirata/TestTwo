<?php

namespace App\Http\Controllers\Api;

use App\Cpu;
use App\Hospital;
use GuzzleHttp\Client;
use App\Events\ServerAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CpuResource;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

use function GuzzleHttp\json_encode;
use Illuminate\Support\Facades\Validator;

class CpuApiController extends Controller
{
    //

    public function index()
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

        $countbackup = DB::table('backup_info')->count();
        $countcpu = DB::table('cpu')->count();
        $counthospital = DB::table('queries')->count();

        $countall = [
            'backup' => $countbackup,
            'cpu' => $countcpu,
            'hospital' => $counthospital
        ];
        
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'count' => $countall
        ]);
    }

    


    public function store(Request $request)


    {

        // dd($request->all());

        // $dat = [
        //     env('HOSPITAL_NAME'),
        //     env('HOSPITAL_SERVER'),            
        // ];

        // dd($dat);

        $queryy = "WITH SpaceUsage AS (
                    SELECT 
                        SUM(CASE WHEN mf.[type] = 0 THEN mf.size * 8.0 / 1024 END) AS data_used_size,
                        SUM(CASE WHEN mf.[type] = 1 THEN mf.size * 8.0 / 1024 END) AS log_used_size
                    FROM sys.master_files mf
                    JOIN sys.databases d ON d.database_id = mf.database_id
                    WHERE d.[state] = 0
                ),
                DiskUsage AS (
                    SELECT 
                        SUM(CAST(mf.size * 8.0 / 1024 AS DECIMAL(18,2))) AS total_size,
                        SUM(CASE WHEN mf.[type] = 0 THEN CAST(mf.size * 8.0 / 1024 AS DECIMAL(18,2)) END) AS data_size,
                        (SELECT SUM(data_used_size) FROM SpaceUsage) AS used_data_size
                    FROM sys.master_files mf
                    JOIN sys.databases d ON d.database_id = mf.database_id
                ),
                RAMUsage AS (
                    SELECT
                        (total_physical_memory_kb / 1024) AS total_memory_mb,
                        ((total_physical_memory_kb - available_physical_memory_kb) / 1024) AS memory_in_use_mb,
                        (SELECT physical_memory_in_use_kb / 1024 FROM sys.dm_os_process_memory) AS sql_memory_mb
                    FROM sys.dm_os_sys_memory
                ),
                CPUUsage AS (
                    SELECT 
                        (100 - x.value('(./Record/SchedulerMonitorEvent/SystemHealth/SystemIdle/text())[1]', 'TINYINT')) AS cpu_total,
                        (cpu_sql / cpu_base * 100) AS cpu_sql
                    FROM (
                        SELECT TOP(1) [timestamp], x = CONVERT(XML, record)
                        FROM sys.dm_os_ring_buffers
                        WHERE ring_buffer_type = N'RING_BUFFER_SCHEDULER_MONITOR'
                        AND record LIKE '%<SystemHealth>%'
                        ORDER BY [timestamp] DESC
                    ) r
                    CROSS APPLY (
                        SELECT 
                            MAX(CASE WHEN counter_name = 'CPU usage %' THEN cntr_value END) AS cpu_sql,
                            MAX(CASE WHEN counter_name = 'CPU usage % base' THEN cntr_value END) AS cpu_base
                        FROM sys.dm_os_performance_counters
                        WHERE counter_name IN ('CPU usage %', 'CPU usage % base')
                        AND instance_name = 'default'
                    ) pc
                )
                SELECT
                    'server' AS server,
                    cpu.cpu_total AS cpu_utilization,
                    ISNULL(cpu.cpu_sql, 0) AS cpu_sql_util,
                    ram.total_memory_mb,
                    ram.memory_in_use_mb,
                    ram.sql_memory_mb,
                    disk.total_size AS disk_size,
                    disk.data_size AS data_size,
                    disk.used_data_size
                FROM CPUUsage cpu
                CROSS JOIN RAMUsage ram
                CROSS JOIN DiskUsage disk;

                ";

                $quer = "DECLARE @lastNmin INT;
                SET @lastNmin = 10;

                SELECT TOP 10
                    CONVERT(CHAR(100), SERVERPROPERTY('Servername')) AS Server,
                    dest.TEXT AS [Query],
                    SUM(deqs.execution_count) AS [Count],
                    MAX(deqs.last_execution_time) AS [Time]
                FROM sys.dm_exec_query_stats AS deqs
                CROSS APPLY sys.dm_exec_sql_text(deqs.sql_handle) AS dest
                CROSS APPLY sys.dm_exec_plan_attributes(deqs.plan_handle) AS epa
                WHERE epa.attribute = 'dbid'
                AND DB_NAME(CONVERT(int, epa.value)) NOT IN ('master', 'tempdb', 'model', 'msdb')
                AND deqs.last_execution_time >= DATEADD(MINUTE, -@lastNmin, GETDATE())
                GROUP BY dest.TEXT, DB_NAME(CONVERT(int, epa.value))
                ORDER BY SUM(deqs.execution_count) DESC;";

                $queq = "SELECT 
                A.[Server],  
                A.last_db_backup_date,  
                B.backup_start_date,  
                B.backup_size,  
                B.physical_device_name,   
                B.backupset_name
                FROM 
                ( 
                SELECT   
                    CONVERT(CHAR(100), SERVERPROPERTY('Servername')) AS Server, 
                    msdb.dbo.backupset.database_name,  
                    MAX(msdb.dbo.backupset.backup_finish_date) AS last_db_backup_date 
                FROM 
                    msdb.dbo.backupmediafamily  
                    INNER JOIN msdb.dbo.backupset ON msdb.dbo.backupmediafamily.media_set_id = msdb.dbo.backupset.media_set_id  
                WHERE 
                    msdb..backupset.type = 'D' 
                GROUP BY 
                    msdb.dbo.backupset.database_name  
                ) AS A 
                LEFT JOIN  
                ( 
                SELECT   
                    CONVERT(CHAR(100), SERVERPROPERTY('Servername')) AS Server, 
                    msdb.dbo.backupset.database_name,  
                    msdb.dbo.backupset.backup_start_date,  
                    msdb.dbo.backupset.backup_finish_date, 
                    msdb.dbo.backupset.expiration_date, 
                    msdb.dbo.backupset.backup_size,  
                    msdb.dbo.backupmediafamily.logical_device_name,  
                    msdb.dbo.backupmediafamily.physical_device_name,   
                    msdb.dbo.backupset.name AS backupset_name, 
                    msdb.dbo.backupset.description 
                FROM 
                    msdb.dbo.backupmediafamily  
                    INNER JOIN msdb.dbo.backupset ON msdb.dbo.backupmediafamily.media_set_id = msdb.dbo.backupset.media_set_id  
                WHERE 
                    msdb..backupset.type = 'D' 
                ) AS B 
                ON A.[server] = B.[server] AND A.[database_name] = B.[database_name] AND A.[last_db_backup_date] = B.[backup_finish_date] 
                ORDER BY  
                A.database_name ";



// dd(json_decode($request->get('data')));
        // $after= DB::connection('hospital')->select($queq);
        // dd(json_encode($after));

        // return response()->json([
            //     'status' => 'success',
            //     'message' => 'Data has been saved',
        //     'data' => $request->all()
        // ]);

        
        $message = [
            'required' => 'The :attribute field is required.'
        ];





        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'server' => 'required',
            'cpu_utilization' => 'required',
            'cpu_sql_util' => 'required',
            'total_memory_mb' => 'required',
            'memory_in_use_mb' => 'required',
            'sql_memory_mb' => 'required',
            'disk_size' => 'required',
            'data_size' => 'required',
            'used_data_size' => 'required'

        ], $message);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        
        
        $data = new Cpu();
        $data->name = $request->get('name');
        $data->server = $request->get('server');
        $data->cpu_utilization = $request->get('cpu_utilization');
        $data->cpu_sql_util = $request->get('cpu_sql_util');
        $data->total_memory_mb = $request->get('total_memory_mb');
        $data->memory_in_use_mb = $request->get('memory_in_use_mb');
        $data->sql_memory_mb = $request->get('sql_memory_mb');
        $data->disk_size = $request->get('disk_size');
        $data->data_size = $request->get('data_size');
        $data->used_data_size = $request->get('used_data_size');
        // dd('success');
        
        // dd(Hospital::where('nama_rs', $data['name'])->count());
        if(Hospital::where('nama_rs', $data['name'])->count() == 0){
            $hospital = new Hospital();
            $hospital->nama_rs = $request->get('name');
            $hospital->nama_server = $request->get('server');
            $hospital->save();
        }
        
        
        $data->save();

        $pesan = [
            'namaa' => $data->name,
            'cpu' => $data->cpu_utilization,
            'memory'=> ROUND(($data->memory_in_use_mb/ $data->total_memory_mb)*100,2),
            'disk' => ROUND(($data->used_data_size/ $data->disk_size)*100,2)
        ];

        // event(new ServerAlert($pesan));

        if(max($pesan['cpu'], $pesan['memory'], $pesan['disk']) > 80){
            event(new ServerAlert($pesan));
        }



        return response()->json([
            'status' => 'success',
            'message' => 'Data has been saved',
            'data' => $data
        ]);  
    }

    
}
