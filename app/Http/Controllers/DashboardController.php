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
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'cashier':
                    return redirect()->route('cashier.dashboard');
                case 'waiter':
                    return redirect()->route('waiter.dashboard');
                case 'chef':
                    return redirect()->route('chef.dashboard');
                default:
                    return redirect('/');
            }
        }

        // If user is not logged in, show welcome page
        return view('welcome');
    }
}