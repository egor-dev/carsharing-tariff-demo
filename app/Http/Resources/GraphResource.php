<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GraphResource extends JsonResource
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
            'nodes' => NodeResource::collection($this->nodes),
            'edges' => EdgeResource::collection($this->edges),
        ];
    }
}
