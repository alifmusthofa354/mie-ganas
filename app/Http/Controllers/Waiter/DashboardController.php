<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the waiter dashboard.
     */
    public function index()
    {
        return view('waiter.dashboard');
    }
}