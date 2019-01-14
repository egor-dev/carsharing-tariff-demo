<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Tariff
 *
 * @property int $time_billing_max_cost
 * @property int $graph_id
 *
 * @package App
 */
class Tariff extends Model
{
    public $casts = [
        'time_billing_max_cost' => 'decimal:2'
    ];

    public function stages(): BelongsToMany
    {
        return $this->belongsToMany(Stage::class)->withPivot([
            'cost_per_minute',
            'free_period_since_hour',
            'free_period_till_hour',
            'free_minutes_at_start',
            'cost_per_kilometer',
            'free_kilometers_per_day',
        ]);
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }

    public function graph(): BelongsTo
    {
        return $this->belongsTo(Graph::class);
    }
}
