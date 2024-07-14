<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'oracle_id',
        'multiverse_ids',
        'name',
        'lang',
        'released_at',
        'uri',
        'scryfall_uri',
        'layout',
        'highres_image',
        'image_status',
        'image_uris',
        'mana_cost',
        'cmc',
        'type_line',
        'oracle_text',
        'colors',
        'color_identity',
        'keywords',
        'legalities',
        'games',
        'reserved',
        'foil',
        'nonfoil',
        'finishes',
        'oversized',
        'promo',
        'reprint',
        'variation',
        'set_id',
        'set',
        'set_name',
        'set_type',
        'set_uri',
        'set_search_uri',
        'scryfall_set_uri',
        'rulings_uri',
        'prints_search_uri',
        'collector_number',
        'digital',
        'rarity',
        'flavor_text',
        'card_back_id',
        'artist',
        'artist_ids',
        'illustration_id',
        'border_color',
        'frame',
        'security_stamp',
        'full_art',
        'textless',
        'booster',
        'story_spotlight',
        'edhrec_rank',
        'preview',
        'prices',
        'related_uris',
        'purchase_uris'
    ];

    protected $casts = [
        'multiverse_ids' => 'array',
        'highres_image' => 'boolean',
        'image_uris' => 'array',
        'colors' => 'array',
        'color_identity' => 'array',
        'keywords' => 'array',
        'legalities' => 'array',
        'games' => 'array',
        'reserved' => 'boolean',
        'foil' => 'boolean',
        'nonfoil' => 'boolean',
        'finishes' => 'array',
        'oversized' => 'boolean',
        'promo' => 'boolean',
        'reprint' => 'boolean',
        'variation' => 'boolean',
        'digital' => 'boolean',
        'preview' => 'array',
        'prices' => 'array',
        'related_uris' => 'array',
        'purchase_uris' => 'array',
        'released_at' => 'date'
    ];
}
