<?php

namespace App\Contracts;

interface CaptchaServiceContract
{
    /**
     * Generate a simple math CAPTCHA
     */
    public function generate(): array;

    /**
     * Verify the CAPTCHA answer
     */
    public function verify($userInput): bool;

    /**
     * Clear the stored CAPTCHA result
     */
    public function clear();
}