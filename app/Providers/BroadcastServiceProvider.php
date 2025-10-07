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
        // Gunakan middleware 'web' saja tanpa 'auth' agar bisa digunakan oleh pelanggan
        Broadcast::routes(['middleware' => ['web']]);

        // Muat definisi channel dari routes/channels.php
        require base_path('routes/channels.php');

    }
}