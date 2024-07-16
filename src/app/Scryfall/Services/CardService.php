<?php

namespace App\Scryfall\Services;

use App\Scryfall\Models\Card;
use App\Jobs\SaveImageJob;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CardService implements CardServiceInterface
{
    /**
     * @param string $setCode
     * @return Collection|false
     */
    public function fetchAndSaveCards(string $setCode): Collection|false
    {
        if (!$this->cardsExistInDb($setCode)) {
            try {
                $response = Http::get("https://api.scryfall.com/cards/search?q=set:{$setCode}");

                if ($response->successful()) {
                    $cards = $response->json()['data'];

                    foreach ($cards as $cardData) {
                        $data = [
                            'scryfall_id' => $cardData['id'] ?? null,
                            'oracle_id' => $cardData['oracle_id'] ?? null,
                            'multiverse_ids' => isset($cardData['multiverse_ids']) ? json_encode($cardData['multiverse_ids']) : null,
                            'name' => $cardData['name'] ?? null,
                            'lang' => $cardData['lang'] ?? null,
                            'released_at' => $cardData['released_at'] ?? null,
                            'uri' => $cardData['uri'] ?? null,
                            'scryfall_uri' => $cardData['scryfall_uri'] ?? null,
                            'layout' => $cardData['layout'] ?? null,
                            'highres_image' => $cardData['highres_image'] ?? null,
                            'image_status' => $cardData['image_status'] ?? null,
                            // Some cards have image_uris inside card_faces
                            'image_uris' => (isset($cardData['card_faces'][0]['image_uris']))
                                ? json_encode($cardData['card_faces'][0]['image_uris'])
                                : (isset($cardData['image_uris']) ? json_encode($cardData['image_uris']) : null),
                            'mana_cost' => $cardData['mana_cost'] ?? null,
                            'cmc' => $cardData['cmc'] ?? null,
                            'type_line' => $cardData['type_line'] ?? null,
                            'oracle_text' => $cardData['oracle_text'] ?? null,
                            'colors' => isset($cardData['colors']) ? json_encode($cardData['colors']) : null,
                            'color_identity' => isset($cardData['color_identity']) ? json_encode($cardData['color_identity']) : null,
                            'keywords' => isset($cardData['keywords']) ? json_encode($cardData['keywords']) : null,
                            'legalities' => isset($cardData['legalities']) ? json_encode($cardData['legalities']) : null,
                            'games' => isset($cardData['games']) ? json_encode($cardData['games']) : null,
                            'reserved' => $cardData['reserved'] ?? null,
                            'foil' => $cardData['foil'] ?? null,
                            'nonfoil' => $cardData['nonfoil'] ?? null,
                            'finishes' => isset($cardData['finishes']) ? json_encode($cardData['finishes']) : null,
                            'oversized' => $cardData['oversized'] ?? null,
                            'promo' => $cardData['promo'] ?? null,
                            'reprint' => $cardData['reprint'] ?? null,
                            'variation' => $cardData['variation'] ?? null,
                            'set_id' => $cardData['set_id'] ?? null,
                            'set' => $cardData['set'] ?? null,
                            'set_name' => $cardData['set_name'] ?? null,
                            'set_type' => $cardData['set_type'] ?? null,
                            'set_uri' => $cardData['set_uri'] ?? null,
                            'set_search_uri' => $cardData['set_search_uri'] ?? null,
                            'scryfall_set_uri' => $cardData['scryfall_set_uri'] ?? null,
                            'rulings_uri' => $cardData['rulings_uri'] ?? null,
                            'prints_search_uri' => $cardData['prints_search_uri'] ?? null,
                            'collector_number' => $cardData['collector_number'] ?? null,
                            'digital' => $cardData['digital'] ?? null,
                            'rarity' => $cardData['rarity'] ?? null,
                            'flavor_text' => $cardData['flavor_text'] ?? null,
                            'card_back_id' => $cardData['card_back_id'] ?? null,
                            'artist' => $cardData['artist'] ?? null,
                            'artist_ids' => isset($cardData['artist_ids']) ? json_encode($cardData['artist_ids']) : null,
                            'illustration_id' => $cardData['illustration_id'] ?? null,
                            'border_color' => $cardData['border_color'] ?? null,
                            'frame' => $cardData['frame'] ?? null,
                            'security_stamp' => $cardData['security_stamp'] ?? null,
                            'full_art' => $cardData['full_art'] ?? null,
                            'textless' => $cardData['textless'] ?? null,
                            'booster' => $cardData['booster'] ?? null,
                            'story_spotlight' => $cardData['story_spotlight'] ?? null,
                            'edhrec_rank' => $cardData['edhrec_rank'] ?? null,
                            'preview' => isset($cardData['preview']) ? json_encode($cardData['preview']) : null,
                            'prices' => isset($cardData['prices']) ? json_encode($cardData['prices']) : null,
                            'related_uris' => isset($cardData['related_uris']) ? json_encode($cardData['related_uris']) : null,
                            'purchase_uris' => isset($cardData['purchase_uris']) ? json_encode($cardData['purchase_uris']) : null,
                        ];

                        Card::updateOrCreate(['oracle_id' => $cardData['oracle_id']], array_filter($data));

                        $imageUris = $cardData['card_faces'][0]['image_uris'] ?? ($cardData['image_uris'] ?? []);

                        $this->saveImagesAsync($imageUris);
                    }
                } else {
                    Log::error('Failed to fetch cards from Scryfall', ['setCode' => $setCode, 'response' => $response->body()]);
                }
            } catch (\Exception $e) {
                Log::error('Error fetching cards', ['setCode' => $setCode, 'message' => $e->getMessage()]);
            }

            return Card::where('set', $setCode)->get();
        }
        return false;
    }

    /**
     * @param array $imageUris
     * @return void
     */
    public function saveImagesAsync(array $imageUris): void
    {
        $imageSizes = [
            'small' => $imageUris['small'] ?? null,
            'normal' => $imageUris['normal'] ?? null,
            'large' => $imageUris['large'] ?? null
        ];

        foreach ($imageSizes as $size => $imageUrl) {
            if ($imageUrl) {
                SaveImageJob::dispatch($imageUrl, $size);
            }
        }
    }

    /**
     * @param string $setCode
     * @return bool
     */
    public function cardsExistInDb(string $setCode): bool
    {
        // Check if any cards with the given setCode exist in the database
        $count = Card::where('set', $setCode)->count();

        return $count > 0;
    }

    /**
     * @param string $setCode
     * @return Collection
     */
    public function getCardsBySetCode(string $setCode): Collection
    {
        return Card::where('set', $setCode)->get();
    }

    /**
     * @return Collection
     */
    public function getInitialRandomCards(): Collection
    {
        return Card::inRandomOrder()->take(10)->get();
    }


}
