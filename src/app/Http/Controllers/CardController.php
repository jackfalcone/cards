<?php

namespace App\Http\Controllers;

use App\Scryfall\Models\Card;
use App\Scryfall\Services\CardServiceInterface;
use App\Services\ScryfallService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CardController extends Controller
{

    public function __construct(protected CardServiceInterface $cardService)
    {
    }


    public function fetchCardsFromApi(Request $request): JsonResponse
    {
        Log::debug('Fetching cards from API');

        $setCode = $request->input('setCode');
        $existingCards = Card::where('set', $setCode)->get();

        Log::debug($setCode);
        Log::debug($existingCards);
        if ($existingCards->isNotEmpty()) {
            return JsonResponse::fromJsonString($existingCards);

        }

        $cards = $this->cardService->fetchAndSaveCards($setCode);
        return JsonResponse::fromJsonString($cards);
    }
}
