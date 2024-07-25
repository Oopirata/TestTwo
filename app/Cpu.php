<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cpu extends Model
{



    protected $table = 'cpu';
    protected $fillable = ['name', 
                            'server', 
                            'cpu_utilization',
                            'cpu_sql_util',
                            'total_memory_mb',
                            'memory_in_use_mb',
                            'sql_memory_mb',
                            'disk_size', //awal
                            'data_size', //terpakai
                            'used_data_size'
                        ];

}