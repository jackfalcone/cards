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
            $table->id()->primary();
            $table->string('scryfall_id')->nullable();
            $table->uuid('oracle_id')->nullable();
            $table->json('multiverse_ids')->nullable();
            $table->string('name')->nullable();
            $table->string('lang')->nullable();
            $table->date('released_at')->nullable();
            $table->string('uri')->nullable();
            $table->string('scryfall_uri')->nullable();
            $table->string('layout')->nullable();
            $table->boolean('highres_image')->nullable();
            $table->string('image_status')->nullable();
            $table->json('image_uris')->nullable();
            $table->string('mana_cost')->nullable();
            $table->decimal('cmc', 8, 2)->nullable();
            $table->string('type_line')->nullable();
            $table->text('oracle_text')->nullable();
            $table->json('colors')->nullable();
            $table->json('color_identity')->nullable();
            $table->json('keywords')->nullable();
            $table->json('legalities')->nullable();
            $table->json('games')->nullable();
            $table->boolean('reserved')->nullable();
            $table->boolean('foil')->nullable();
            $table->boolean('nonfoil')->nullable();
            $table->json('finishes')->nullable();
            $table->boolean('oversized')->nullable();
            $table->boolean('promo')->nullable();
            $table->boolean('reprint')->nullable();
            $table->boolean('variation')->nullable();
            $table->uuid('set_id')->nullable();
            $table->string('set')->nullable();
            $table->string('set_name')->nullable();
            $table->string('set_type')->nullable();
            $table->string('set_uri')->nullable();
            $table->string('set_search_uri')->nullable();
            $table->string('scryfall_set_uri')->nullable();
            $table->string('rulings_uri')->nullable();
            $table->string('prints_search_uri')->nullable();
            $table->string('collector_number')->nullable();
            $table->boolean('digital')->nullable();
            $table->string('rarity')->nullable();
            $table->text('flavor_text')->nullable();
            $table->uuid('card_back_id')->nullable();
            $table->string('artist')->nullable();
            $table->json('artist_ids')->nullable();
            $table->uuid('illustration_id')->nullable();
            $table->string('border_color')->nullable();
            $table->string('frame')->nullable();
            $table->string('security_stamp')->nullable();
            $table->boolean('full_art')->nullable();
            $table->boolean('textless')->nullable();
            $table->boolean('booster')->nullable();
            $table->boolean('story_spotlight')->nullable();
            $table->integer('edhrec_rank')->nullable();
            $table->json('preview')->nullable();
            $table->json('prices')->nullable();
            $table->json('related_uris')->nullable();
            $table->json('purchase_uris')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cards');
    }
};
