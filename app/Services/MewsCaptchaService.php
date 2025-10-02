<?php

namespace App\Services;

use App\Contracts\CaptchaServiceContract;
use Illuminate\Support\Facades\Session;
use Mews\Captcha\Facades\Captcha;

class MewsCaptchaService implements CaptchaServiceContract
{
    /**
     * Generate a CAPTCHA using mews/captcha
     */
    public function generate(): array
    {
        // Store the CAPTCHA status in session so we know it's been generated
        Session::put(config('login.session.captcha_generated'), true);
        
        return [
            'question' => 'Please enter the text shown in the image below',
            'input_name' => 'captcha',
            'image_html' => Captcha::img() // Return the HTML for the CAPTCHA image
        ];
    }

    /**
     * Verify the CAPTCHA answer using mews/captcha
     */
    public function verify($userInput): bool
    {
        // Use mews/captcha to verify the input
        $isValid = Captcha::check($userInput);
        
        // Clear the generated flag after verification
        Session::forget(config('login.session.captcha_generated'));
        
        return $isValid;
    }

    /**
     * Clear the stored CAPTCHA result
     */
    public function clear()
    {
        Session::forget(config('login.session.captcha_generated'));
    }
}