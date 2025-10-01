<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Redirect user to appropriate dashboard based on their role.
     */
    public function index()
    {
        if (Auth::check()) {
            // If user is logged in, redirect to their appropriate dashboard
            $user = Auth::user();
            $routeName = $user->role . '.dashboard';

            if (\Illuminate\Support\Facades\Route::has($routeName)) {
                return redirect()->route($routeName);
            }

            // Default fallback if a named route doesn't exist for the user's role
            return redirect('/');
        }

        // If user is not logged in, show welcome page
        return view('welcome');
    }
}