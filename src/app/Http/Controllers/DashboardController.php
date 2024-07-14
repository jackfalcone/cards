<?php

namespace App\Http\Controllers;

use App\Scryfall\Services\CardServiceInterface;
use App\Scryfall\Services\SetServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct(
        protected SetServiceInterface $setService,
        protected CardServiceInterface $cardService
    )
    {

    }

    public function index(Request $request)
    {
        $setCode = $request->input('setCode');
        $cards = $setCode ? $this->cardService->getCardsBySetCode($setCode) : $this->cardService->getInitialRandomCards();

        $sets = $this->setService->fetchAndCacheSets();
        return Inertia::render('Cards/Index', [
            'setCode' => $setCode,
            'sets' => $sets,
            'cards' => $cards,
        ]);
    }
}
