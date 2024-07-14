<?php

namespace App\Scryfall\Services;

namespace App\Scryfall\Services;

use Illuminate\Support\Collection;


interface SetServiceInterface
{
    public function fetchAndCacheSets(): Collection;
}
