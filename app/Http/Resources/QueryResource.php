<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QueryResource extends JsonResource
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
            'query' => $this->query,
            'count' => $this->count,
            'lastQuery' => $this->last_query
 
        ];
    }
}
