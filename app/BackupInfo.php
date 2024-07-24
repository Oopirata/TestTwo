<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BackupInfo extends Model
{
    //
    protected $table = 'backup_info';

    protected $fillable = [
        'name',
        'server',
        'database_name',
        'last_db_backup_date',
        'backup_start_date',
        'backup_size',
        'physical_device_name',
        'backupset_name'
    ];

}
