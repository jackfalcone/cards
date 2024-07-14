<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\SetController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SetController::class, 'index'])->name('dashboard');
Route::get('/cards', [CardController::class, 'index'])->name('cards.index');
Route::post('/cards/fetch', [CardController::class, 'fetch'])->name('cards.fetch');


