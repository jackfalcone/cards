<?php

namespace App\Providers;

use App\Scryfall\Services\CardService;
use App\Scryfall\Services\CardServiceInterface;
use App\Scryfall\Services\SetService;
use App\Scryfall\Services\SetServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CardServiceInterface::class => CardService::class,
        SetServiceInterface::class => SetService::class
    ];

}
