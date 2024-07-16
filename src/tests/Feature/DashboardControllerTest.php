<?php

namespace Tests\Feature;

use App\Http\Controllers\DashboardController;
use App\Scryfall\Services\CardServiceInterface;
use App\Scryfall\Services\SetServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    }

    /** @test */
    public function index_method_displays_dashboard_with_random_cards_and_sets()
    {
        $setService = $this->mock(SetServiceInterface::class);
        $cardService = $this->mock(CardServiceInterface::class);

        $mockedSets = collect([
            ['name' => 'Set 1'],
            ['name' => 'Set 2'],
        ]);

        $mockedRandomCards = collect([
            ['name' => 'Card 1'],
            ['name' => 'Card 2'],
        ]);

        $setService->shouldReceive('fetchAndCacheSets')->andReturn($mockedSets);
        $cardService->shouldReceive('getInitialRandomCards')->andReturn($mockedRandomCards);

        $response = $this->get(route('dashboard'));

        $response->assertStatus(200)
            ->assertInertia(function (Assert $page) use ($mockedSets, $mockedRandomCards) {
                $page->component('Cards/Index')
                    ->where('sets', $mockedSets)
                    ->where('randomCards', $mockedRandomCards);
            });
    }

    /** @test */
    public function index_method_redirects_back_with_error_message_on_exception()
    {
        $setService = $this->mock(SetServiceInterface::class);

        $setService->shouldReceive('fetchAndCacheSets')->andThrow(new \Exception('Service unavailable'));

        $response = $this->get(route('dashboard'));

        $response->assertStatus(302)
            ->assertSessionHas('error', 'Failed to fetch data. Please try again later.');
    }
}

