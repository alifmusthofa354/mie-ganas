<?php

namespace App\Listeners;

use App\Events\LoginSuccessful;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UpdateLastLogin
{
    /**
     * Handle the event.
     */
    public function handle(LoginSuccessful $event): void
    {
        try {
            // Use User model to update the last login details
            User::where('id', $event->user->id)->update([
                'last_login_at' => now(),
                'last_login_ip' => $event->ip,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to update last login', [
                'user_id' => $event->user->id ?? 'unknown',
                'error' => $e->getMessage(),
            ]);
        }
    }
}