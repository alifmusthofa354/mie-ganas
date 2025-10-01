<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Cashier\DashboardController as CashierDashboardController;
use App\Http\Controllers\Waiter\DashboardController as WaiterDashboardController;
use App\Http\Controllers\Chef\DashboardController as ChefDashboardController;



// Redirect root path based on authentication status
Route::get("/", function () {
    return view("welcome");
});

Route::get("lele", function () {
    return view("lele");
});

Route::get('/nana', function () {
    return view('nana');
})->name('nana');

// Redirect root path based on authentication status
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Public login routes
Route::get('/login', [AuthenticationController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [AuthenticationController::class, 'login'])
    ->name('login.post')
    ->middleware('guest');

// Logout route
Route::post('/logout', [AuthenticationController::class, 'logout'])
    ->name('logout');

// Dashboard routes using controllers with role-based middleware
Route::get('/admin', [AdminDashboardController::class, 'index'])
    ->middleware('auth', 'checkRole:admin')
    ->name('admin.dashboard');

Route::get('/cashier', [CashierDashboardController::class, 'index'])
    ->middleware('auth', 'checkRole:cashier')
    ->name('cashier.dashboard');

Route::get('/waiter', [WaiterDashboardController::class, 'index'])
    ->middleware('auth', 'checkRole:waiter')
    ->name('waiter.dashboard');

Route::get('/chef', [ChefDashboardController::class, 'index'])
    ->middleware('auth', 'checkRole:chef')
    ->name('chef.dashboard');