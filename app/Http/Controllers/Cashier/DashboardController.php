<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the cashier dashboard.
     */
    public function index()
    {
        return view('cashier.dashboard');
    }
}