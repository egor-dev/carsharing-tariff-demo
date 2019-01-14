<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EdgeResource extends JsonResource
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
            'source_node_id' => $this->source_node_id,
            'target_node_id' => $this->target_node_id,
        ];
    }
}
