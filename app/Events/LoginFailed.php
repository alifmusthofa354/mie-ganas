<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LoginFailed
{
    use Dispatchable, SerializesModels;

    public $email;
    public $ip;
    public $userAgent;

    public function __construct($email, $ip, $userAgent = null)
    {
        $this->email = $email;
        $this->ip = $ip;
        $this->userAgent = $userAgent;
    }
}