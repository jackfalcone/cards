<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Scryfall\Services\CardService;
use App\Jobs\SaveImageJob;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;

class CardServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testFetchAndSaveCardsWhenCardsDoNotExist()
    {
        Queue::fake();
        Http::fake([
            'https://api.scryfall.com/cards/search?q=set:abc' => Http::response([
                'data' => [
                    [
                        'id' => '1',
                        'oracle_id' => 'oracle-1',
                        'name' => 'Test Card',
                        'set' => 'abc',
                        'image_uris' => ['normal' => 'http://example.com/image.jpg']
                    ]
                ]
            ])
        ]);

        $service = new CardService();

        $result = $service->fetchAndSaveCards('abc');

        $this->assertCount(1, $result);
        $this->assertDatabaseHas('cards', ['oracle_id' => 'oracle-1']);
        Queue::assertPushed(SaveImageJob::class);
    }

    public function testSaveImagesAsync()
    {
        Queue::fake();
        $service = new CardService();
        $imageUris = [
            'small' => 'http://example.com/small.jpg',
            'normal' => 'http://example.com/normal.jpg',
            'large' => 'http://example.com/large.jpg'
        ];

        $service->saveImagesAsync($imageUris);

        Queue::assertPushed(SaveImageJob::class, function ($job) use ($imageUris) {
            return $job->imageUrl === $imageUris['small'] && $job->size === 'small';
        });
        Queue::assertPushed(SaveImageJob::class, function ($job) use ($imageUris) {
            return $job->imageUrl === $imageUris['normal'] && $job->size === 'normal';
        });
        Queue::assertPushed(SaveImageJob::class, function ($job) use ($imageUris) {
            return $job->imageUrl === $imageUris['large'] && $job->size === 'large';
        });
    }
}
