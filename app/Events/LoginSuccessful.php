<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LoginSuccessful
{
    use Dispatchable, SerializesModels;

    public $user;
    public $ip;
    public $userAgent;

    public function __construct(User $user, $ip, $userAgent = null)
    {
        $this->user = $user;
        $this->ip = $ip;
        $this->userAgent = $userAgent;
    }
}