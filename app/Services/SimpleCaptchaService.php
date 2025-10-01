<?php

namespace App\Services;

use App\Contracts\CaptchaServiceContract;

class SimpleCaptchaService implements CaptchaServiceContract
{
    /**
     * Generate a simple math CAPTCHA
     */
    public function generate(): array
    {
        $num1 = rand(1, 20);
        $num2 = rand(1, 20);
        $result = $num1 + $num2;
        
        // Store the result in session
        session(['captcha_result' => $result]);
        
        return [
            'question' => "What is {$num1} + {$num2}?",
            'input_name' => 'captcha_answer'
        ];
    }

    /**
     * Verify the CAPTCHA answer
     */
    public function verify($userInput): bool
    {
        $expected = session('captcha_result');
        
        // Clear the stored result after verification
        session()->forget('captcha_result');
        
        return $expected !== null && (int)$userInput === (int)$expected;
    }

    /**
     * Clear the stored CAPTCHA result
     */
    public function clear()
    {
        session()->forget('captcha_result');
    }
}