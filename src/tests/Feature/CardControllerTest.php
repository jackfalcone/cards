<?php

namespace Tests\Feature;

use App\Http\Controllers\CardController;
use App\Scryfall\Services\CardServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class CardControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Additional setup if needed
    }

    /** @test */
    public function fetch_cards_from_api_without_set_code()
    {
        // Create a request instance without setCode
        $request = Request::create('/api/fetch-cards', 'POST');

        // Create an instance of CardController
        $controller = new CardController(app(CardServiceInterface::class));

        // Call the fetchCardsFromApi method
        $response = $controller->fetchCardsFromApi($request);

        // Assert the response
        $this->assertEquals(['error' => 'setCode parameter is required'], $response->getData(true));
    }

    /** @test */
    public function fetch_cards_from_db_without_set_code()
    {
        // Create a request instance without setCode
        $request = Request::create('/api/fetch-cards-db', 'POST');

        // Create an instance of CardController
        $controller = new CardController(app(CardServiceInterface::class));

        // Call the fetchCardsFromDb method
        $response = $controller->fetchCardsFromDb($request);

        // Assert the response
        $this->assertEquals(['error' => 'setCode parameter is required'], $response->getData(true));
    }
}
