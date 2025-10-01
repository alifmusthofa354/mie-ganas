<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

            if (Route::has($routeName)) {
                return redirect()->route($routeName);
            }

            // Default fallback if a named route doesn't exist for the user's role
            return redirect('/');
        }

        // If user is not logged in, show welcome page
        return view('welcome');
    }
}