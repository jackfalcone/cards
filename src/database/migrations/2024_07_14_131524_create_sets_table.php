<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->integer('tcgplayer_id')->nullable();
            $table->string('name');
            $table->string('uri');
            $table->string('scryfall_uri');
            $table->string('search_uri');
            $table->date('released_at');
            $table->string('set_type');
            $table->integer('card_count');
            $table->boolean('digital');
            $table->boolean('nonfoil_only');
            $table->boolean('foil_only');
            $table->string('block_code')->nullable();
            $table->string('block')->nullable();
            $table->string('icon_svg_uri');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sets');
    }
};
