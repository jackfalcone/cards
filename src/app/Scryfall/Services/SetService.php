<?php

namespace App\Scryfall\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SetService implements SetServiceInterface
{
    /**
     * @return Collection
     */
    public function fetchAndCacheSets(): Collection
    {
        return Cache::remember('sets', now()->addDay(), function () {
            $response = Http::get("https://api.scryfall.com/sets");
            $sets = $response->json()['data'];

            return collect($sets);
        });
    }
}
