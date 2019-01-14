<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $freePeriod = null;
        if ($this->pivot->free_minutes_since_hour && $this->pivot->free_minutes_till_hour) {
            $freePeriod = [
                'since_hour' => $this->pivot->free_minutes_since_hour,
                'till_hour' => $this->pivot->free_minutes_till_hour,
            ];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'billing' => [
                'free_period' => $freePeriod,
                'cost_per_minute' => $this->pivot->cost_per_minute,
                'cost_per_kilometer' => $this->pivot->cost_per_kilometer,
                'free_minutes_at_start' => $this->pivot->free_minutes_at_start,
                'free_kilometers_per_day' => $this->pivot->free_kilometers_per_day,
            ],
        ];
    }
}
