<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Auth\Authenticatable;

class LoginSuccessful
{
    use Dispatchable, SerializesModels;

    public $user;
    public $ip;
    public $userAgent;

    public function __construct(Authenticatable $user, $ip, $userAgent = null)
    {
        $this->user = $user;
        $this->ip = $ip;
        $this->userAgent = $userAgent;
    }
}