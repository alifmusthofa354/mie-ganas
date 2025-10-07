<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Panggil Broadcast::routes() untuk mengaktifkan route otorisasi

        Broadcast::routes(['middleware' => ['web', 'auth']]);

        // Muat definisi channel dari routes/channels.php
        require base_path('routes/channels.php');

    }
}