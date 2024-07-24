<?php

namespace App\Scryfall\Services;

use http\Client\Response;
use Illuminate\Support\Collection;

interface CardServiceInterface
{
    /**
     * @param string $setCode
     * @return Collection|false
     */
    public function fetchAndSaveCards(string $setCode): Collection|false;

    /**
     * @param string $setCode
     * @return Collection
     */
    public function getCardsBySetCode(string $setCode): Collection;

    /**
     * @return Collection
     */
    public function getInitialRandomCards(): Collection;

    /**
     * @param string $setCode
     * @return bool
     */
    public function cardsExistInDb(string $setCode): bool;

    /**
     * @param array $imageUris
     * @param string $oracleId
     * @return void
     */
    public function saveImagesAsync(array $imageUris, string $oracleId): void;

}
