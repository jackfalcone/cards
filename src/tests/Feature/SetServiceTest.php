<?php

namespace Tests\Feature;

use App\Scryfall\Services\SetService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Tests\TestCase;

class SetServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_fetches_and_caches_sets_from_scryfall_api()
    {
        Http::fake([
            'https://api.scryfall.com/sets' => Http::response([
                'data' => [
                    ['id' => 'set1', 'name' => 'Set 1'],
                    ['id' => 'set2', 'name' => 'Set 2'],
                ]
            ])
        ]);

        $service = new SetService();

        $sets = $service->fetchAndCacheSets();

        $this->assertInstanceOf(Collection::class, $sets);

        $this->assertEquals(['set1', 'set2'], $sets->pluck('id')->toArray());

        $cachedSets = Cache::get('sets');
        $this->assertEquals(['set1', 'set2'], $cachedSets->pluck('id')->toArray());
    }
}
