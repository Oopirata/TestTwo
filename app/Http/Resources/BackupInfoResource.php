<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BackupInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [

            'id' => $this->id,
            'name' => $this->name,
            'server' => $this->server,
            'databaseName' => $this->database_name,
            'lastDbBackupDate' => $this->last_db_backup_date,
            'backupStartDate' => $this->backup_start_date,
            'backupSize' => $this->backup_size,
            'physicalDeviceName' => $this->physical_device_name,
            'backupsetName' => $this->backupset_name
        ];
    }
}
