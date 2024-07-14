<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('oracle_id');
            $table->json('multiverse_ids');
            $table->string('name');
            $table->string('lang');
            $table->date('released_at');
            $table->string('uri');
            $table->string('scryfall_uri');
            $table->string('layout');
            $table->boolean('highres_image');
            $table->string('image_status');
            $table->json('image_uris');
            $table->string('mana_cost')->nullable();
            $table->decimal('cmc', 8, 2);
            $table->string('type_line');
            $table->text('oracle_text');
            $table->json('colors');
            $table->json('color_identity');
            $table->json('keywords');
            $table->json('legalities');
            $table->json('games');
            $table->boolean('reserved');
            $table->boolean('foil');
            $table->boolean('nonfoil');
            $table->json('finishes');
            $table->boolean('oversized');
            $table->boolean('promo');
            $table->boolean('reprint');
            $table->boolean('variation');
            $table->uuid('set_id');
            $table->string('set');
            $table->string('set_name');
            $table->string('set_type');
            $table->string('set_uri');
            $table->string('set_search_uri');
            $table->string('scryfall_set_uri');
            $table->string('rulings_uri');
            $table->string('prints_search_uri');
            $table->string('collector_number');
            $table->boolean('digital');
            $table->string('rarity');
            $table->text('flavor_text')->nullable();
            $table->uuid('card_back_id');
            $table->string('artist');
            $table->json('artist_ids');
            $table->uuid('illustration_id');
            $table->string('border_color');
            $table->string('frame');
            $table->string('security_stamp')->nullable();
            $table->boolean('full_art');
            $table->boolean('textless');
            $table->boolean('booster');
            $table->boolean('story_spotlight');
            $table->integer('edhrec_rank')->nullable();
            $table->json('preview')->nullable();
            $table->json('prices');
            $table->json('related_uris');
            $table->json('purchase_uris');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cards');
    }
};
