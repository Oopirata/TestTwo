<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CpuResource extends JsonResource
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
            'cpuUtilization' => $this->cpu_utilization,
            'cpuSqlUtilization' => $this->cpu_sql_util,
            'totalMemory' => $this->total_memory_mb,
            'usedMemory' => $this->memory_in_use_mb,
            'usedSqlMemory' => $this->sql_memory_mb,
            'diskSize' => $this->disk_size,
            'dataSize' => $this->data_size,
            'usedDataSize' => $this->used_data_size,  
        ];
    }
}
