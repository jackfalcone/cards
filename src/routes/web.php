<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/',  [DashboardController::class, 'index'])->name('dashboard');
Route::get('/cards/fetch', [CardController::class, 'fetchCardsFromApi'])->name('cards.fetch');


