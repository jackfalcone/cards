<?php

namespace App\Http\Controllers;

use App\Scryfall\Models\Card;
use App\Scryfall\Services\CardServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardController extends Controller
{

    public function __construct(protected CardServiceInterface $cardService)
    {
    }


    public function fetchCardsFromApi(Request $request): JsonResponse
    {
        $setCode = $request->input('setCode');
        $cards = $this->cardService->fetchAndSaveCards($setCode);

        return JsonResponse::fromJsonString($cards);
    }

    public function fetchCardsFromDb(Request $request): JsonResponse
    {
        $setCode = $request->input('setCode');
        $existingCards = Card::where('set', $setCode)->get();

        return JsonResponse::fromJsonString($existingCards);
    }

}
