<?php

namespace App\Scryfall\Services;

use Illuminate\Support\Collection;

interface CardServiceInterface
{
    public function fetchAndSaveCards(string $setCode): Collection;

    public function getCardsBySetCode(string $setCode): Collection;

    public function getInitialRandomCards(): Collection;
}
