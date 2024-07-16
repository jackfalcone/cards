<?php

namespace App\Http\Controllers;

use App\Scryfall\Services\CardServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardController extends Controller
{

    /**
     * @param CardServiceInterface $cardService
     */
    public function __construct(protected CardServiceInterface $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function fetchCardsFromApi(Request $request): JsonResponse
    {
        $setCode = $request->input('setCode');

        if (!$setCode) {
            return response()->json(['error' => 'setCode parameter is required'], 400);
        }

        $cards = $this->cardService->fetchAndSaveCards($setCode);

        return response()->json($cards);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function fetchCardsFromDb(Request $request): JsonResponse
    {
        $setCode = $request->input('setCode');

        if (!$setCode) {
            return response()->json(['error' => 'setCode parameter is required'], 400);
        }

        $existingCards = $this->cardService->getCardsBySetCode($setCode);

        return response()->json($existingCards);
    }

}
