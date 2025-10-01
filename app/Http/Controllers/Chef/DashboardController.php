<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the chef dashboard.
     */
    public function index()
    {
        return view('chef.dashboard');
    }
}