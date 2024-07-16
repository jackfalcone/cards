<?php

namespace App\Http\Controllers;

use App\Scryfall\Services\CardServiceInterface;
use App\Scryfall\Services\SetServiceInterface;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse; // Import Response alias
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    /**
     * @param SetServiceInterface $setService
     * @param CardServiceInterface $cardService
     */
    public function __construct(
        protected SetServiceInterface $setService,
        protected CardServiceInterface $cardService
    )
    {

    }

    /**
     * @return InertiaResponse|RedirectResponse
     */
    public function index(): InertiaResponse|RedirectResponse
    {
        try {
            $randomCards = $this->cardService->getInitialRandomCards();
            $sets = $this->setService->fetchAndCacheSets();
        } catch (\Exception $e) {
            Log::error('Error fetching random cards or sets', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to fetch data. Please try again later.');
        }

        return Inertia::render('Cards/Index', [
            'sets' => $sets,
            'randomCards' => $randomCards
        ]);
    }
}
