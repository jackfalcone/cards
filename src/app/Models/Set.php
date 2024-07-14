<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'tcgplayer_id',
        'name',
        'uri',
        'scryfall_uri',
        'search_uri',
        'released_at',
        'set_type',
        'card_count',
        'digital',
        'nonfoil_only',
        'foil_only',
        'block_code',
        'block',
        'icon_svg_uri'
    ];

    protected $casts = [
        'digital' => 'boolean',
        'nonfoil_only' => 'boolean',
        'foil_only' => 'boolean',
        'released_at' => 'date'
    ];
}
