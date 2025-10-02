<?php

namespace App\Listeners;

use App\Events\LoginSuccessful;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     */
    public function handle(LoginSuccessful $event): void
    {
        Log::info('Successful login', [
            'user_id' => $event->user->id,
            'email' => $event->user->email,
            'ip' => $event->ip,
            'user_agent' => $event->userAgent,
            'timestamp' => now(),
        ]);
    }
}