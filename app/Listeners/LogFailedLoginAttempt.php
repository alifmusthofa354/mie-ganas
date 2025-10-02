<?php

namespace App\Listeners;

use App\Events\LoginFailed;
use Illuminate\Support\Facades\Log;

class LogFailedLoginAttempt
{
    /**
     * Handle the event.
     */
    public function handle(LoginFailed $event): void
    {
        Log::warning('Failed login attempt', [
            'email' => $event->email,
            'ip' => $event->ip,
            'user_agent' => $event->userAgent,
            'timestamp' => now(),
        ]);
    }
}