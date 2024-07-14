<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Services\ScryfallService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CardController extends Controller
{
    protected $scryfallService;

    public function __construct(ScryfallService $scryfallService)
    {
        $this->scryfallService = $scryfallService;
    }

    public function index()
    {
        $cards = Card::all();
        return Inertia::render('Cards', ['cards' => $cards]);
    }

    public function fetch(Request $request)
    {
        $set = $request->input('set');
        $this->scryfallService->fetchAndSaveCards($set);
        return redirect()->back()->with('success', 'Cards fetched successfully!');
    }
}
