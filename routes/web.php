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
})->name("lele")->middleware('throttle:5,1');

Route::get('/nana', function () {
    return view('nana');
})->name('nana')->middleware('throttle:10,1');

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

// Dashboard routes not using middleware to allow guest access 
// but use laravel gate in AuthServiceProvider
Route::get('/admin', [AdminDashboardController::class, 'index'])
    ->middleware('can:has-role,"admin","Only Admins can access this page."')
    ->name('admin.dashboard');

Route::get('/cashier', [CashierDashboardController::class, 'index'])
    ->middleware('can:has-role,"cashier","Only Cashiers can access this page."')
    ->name('cashier.dashboard');

Route::get('/waiter', [WaiterDashboardController::class, 'index'])
    ->middleware('can:has-role,"waiter","Only Waiters can access this page."')
    ->name('waiter.dashboard');

Route::get('/chef', [ChefDashboardController::class, 'index'])
    ->middleware('can:has-role,"chef","Only Chefs can access this page."')
    ->name('chef.dashboard');