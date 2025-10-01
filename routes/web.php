<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Cashier\DashboardController as CashierDashboardController;
use App\Http\Controllers\Waiter\DashboardController as WaiterDashboardController;
use App\Http\Controllers\Chef\DashboardController as ChefDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nana', function () {
    return view('nana');
})->name('nana');

Route::post('/login', function () {
    return "login";
})->name("login");

Route::get("lele", function () {
    return view("lele");
});

// Dashboard routes using controllers
Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/cashier', [CashierDashboardController::class, 'index'])->name('cashier.dashboard');
Route::get('/waiter', [WaiterDashboardController::class, 'index'])->name('waiter.dashboard');
Route::get('/chef', [ChefDashboardController::class, 'index'])->name('chef.dashboard');