<?php

namespace App\Http\Resources;

use App\Graph;
use Illuminate\Http\Resources\Json\JsonResource;

class TariffResource extends JsonResource
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
            'stages' => StageResource::collection($this->stages),
            'graph' => GraphResource::make($this->graph),
            'billing' => [
                'time_billing_max_cost' => $this->time_billing_max_cost,
            ]
        ];
    }
}
