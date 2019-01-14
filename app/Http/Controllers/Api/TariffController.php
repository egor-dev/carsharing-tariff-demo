<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TariffResource;
use App\Tariff;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

/**
 * Class TariffController
 * @package App\Http\Controllers\Api
 */
class TariffController extends Controller
{
    private const CACHE_MINUTES = 3600;

    /**
     * Получить данные тарифа.
     *
     * @param $id
     * @return TariffResource
     */
    public function show($id): TariffResource
    {
        $tariff = Cache::remember(
            "tariffs.$id",
            self::CACHE_MINUTES,
            function () use ($id) {
                return Tariff::query()
                    ->with('stages', 'graph', 'graph.nodes', 'graph.edges')
                    ->findOrFail($id);
            }
        );

        return new TariffResource($tariff);
    }
}
