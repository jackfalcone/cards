<?php

namespace App\Scryfall\Services;

use http\Client\Response;
use Illuminate\Support\Collection;

interface CardServiceInterface
{
    public function fetchAndSaveCards(string $setCode): Collection|false;

    public function getCardsBySetCode(string $setCode): Collection;

    public function getInitialRandomCards(): Collection;

}
