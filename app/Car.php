<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Car
 *
 * @property int $car_class_id
 * @property string $geom
 *
 * @package App
 */
class Car extends Model
{
    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }
}
