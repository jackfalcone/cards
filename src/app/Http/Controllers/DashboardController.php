<?php

namespace App\Http\Controllers;

use App\Scryfall\Services\CardServiceInterface;
use App\Scryfall\Services\SetServiceInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct(
        protected SetServiceInterface $setService,
        protected CardServiceInterface $cardService
    )
    {

    }

    /**
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request): \Inertia\Response
    {
        $randomCards = $this->cardService->getInitialRandomCards();

        $sets = $this->setService->fetchAndCacheSets();
        return Inertia::render('Cards/Index', [
            'sets' => $sets,
            'randomCards' => $randomCards
        ]);
    }
}
