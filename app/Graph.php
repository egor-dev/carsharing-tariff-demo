<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Graph
 *
 * @property int $id
 *
 * @package App
 */
class Graph extends Model
{
    public function nodes(): HasMany
    {
        return $this->hasMany(Node::class);
    }

    public function edges(): HasMany
    {
        return $this->hasMany(Edge::class);
    }
}
