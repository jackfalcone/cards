<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Set;
use Illuminate\Support\Facades\Http;

class ScryfallService
{
    public function fetchAndSaveCards($setCode)
    {
        $response = Http::get("https://api.scryfall.com/cards/search?q=set:{$setCode}");
        $cards = $response->json()['data'];

        foreach ($cards as $cardData) {
            Card::updateOrCreate(
                ['id' => $cardData['id']],
                [
                    'oracle_id' => $cardData['oracle_id'],
                    'multiverse_ids' => $cardData['multiverse_ids'],
                    'name' => $cardData['name'],
                    'lang' => $cardData['lang'],
                    'released_at' => $cardData['released_at'],
                    'uri' => $cardData['uri'],
                    'scryfall_uri' => $cardData['scryfall_uri'],
                    'layout' => $cardData['layout'],
                    'highres_image' => $cardData['highres_image'],
                    'image_status' => $cardData['image_status'],
                    'image_uris' => $cardData['image_uris'],
                    'mana_cost' => $cardData['mana_cost'],
                    'cmc' => $cardData['cmc'],
                    'type_line' => $cardData['type_line'],
                    'oracle_text' => $cardData['oracle_text'],
                    'colors' => $cardData['colors'],
                    'color_identity' => $cardData['color_identity'],
                    'keywords' => $cardData['keywords'],
                    'legalities' => $cardData['legalities'],
                    'games' => $cardData['games'],
                    'reserved' => $cardData['reserved'],
                    'foil' => $cardData['foil'],
                    'nonfoil' => $cardData['nonfoil'],
                    'finishes' => $cardData['finishes'],
                    'oversized' => $cardData['oversized'],
                    'promo' => $cardData['promo'],
                    'reprint' => $cardData['reprint'],
                    'variation' => $cardData['variation'],
                    'set_id' => $cardData['set_id'],
                    'set' => $cardData['set'],
                    'set_name' => $cardData['set_name'],
                    'set_type' => $cardData['set_type'],
                    'set_uri' => $cardData['set_uri'],
                    'set_search_uri' => $cardData['set_search_uri'],
                    'scryfall_set_uri' => $cardData['scryfall_set_uri'],
                    'rulings_uri' => $cardData['rulings_uri'],
                    'prints_search_uri' => $cardData['prints_search_uri'],
                    'collector_number' => $cardData['collector_number'],
                    'digital' => $cardData['digital'],
                    'rarity' => $cardData['rarity'],
                    'flavor_text' => $cardData['flavor_text'],
                    'card_back_id' => $cardData['card_back_id'],
                    'artist' => $cardData['artist'],
                    'artist_ids' => $cardData['artist_ids'],
                    'illustration_id' => $cardData['illustration_id'],
                    'border_color' => $cardData['border_color'],
                    'frame' => $cardData['frame'],
                    'security_stamp' => $cardData['security_stamp'],
                    'full_art' => $cardData['full_art'],
                    'textless' => $cardData['textless'],
                    'booster' => $cardData['booster'],
                    'story_spotlight' => $cardData['story_spotlight'],
                    'edhrec_rank' => $cardData['edhrec_rank'],
                    'preview' => $cardData['preview'],
                    'prices' => $cardData['prices'],
                    'related_uris' => $cardData['related_uris'],
                    'purchase_uris' => $cardData['purchase_uris'],
                ]
            );
        }
    }

    public function fetchAndSaveSets()
    {
        $response = Http::get("https://api.scryfall.com/sets");
        $sets = $response->json()['data'];

        foreach ($sets as $setData) {
            Set::updateOrCreate(
                ['id' => $setData['id']],
                [
                    'code' => $setData['code'],
                    'tcgplayer_id' => $setData['tcgplayer_id'],
                    'name' => $setData['name'],
                    'uri' => $setData['uri'],
                    'scryfall_uri' => $setData['scryfall_uri'],
                    'search_uri' => $setData['search_uri'],
                    'released_at' => $setData['released_at'],
                    'set_type' => $setData['set_type'],
                    'card_count' => $setData['card_count'],
                    'digital' => $setData['digital'],
                    'nonfoil_only' => $setData['nonfoil_only'],
                    'foil_only' => $setData['foil_only'],
                    'block_code' => $setData['block_code'],
                    'block' => $setData['block'],
                    'icon_svg_uri' => $setData['icon_svg_uri'],
                ]
            );
        }
    }
}
