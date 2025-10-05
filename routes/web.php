<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Cashier\DashboardController as CashierDashboardController;
use App\Http\Controllers\Waiter\DashboardController as WaiterDashboardController;
use App\Http\Controllers\Chef\DashboardController as ChefDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;


// Redirect root path based on authentication status
Route::get('/', [App\Http\Controllers\Customer\CustomerController::class, 'showTableForm'])->name('customer.table');
// Customer routes
Route::post('/customer/select-table', [App\Http\Controllers\Customer\CustomerController::class, 'selectTable'])->name('customer.select-table');
Route::get('/customer/menu', [App\Http\Controllers\Customer\CustomerController::class, 'menu'])->name('customer.menu');
Route::get('/table/{tableNumber}/{sessionId?}', [App\Http\Controllers\Customer\CustomerController::class, 'qrLogin'])->name('customer.qr-login');
Route::post('/customer/logout', [App\Http\Controllers\Customer\CustomerController::class, 'logout'])->name('customer.logout');

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

Route::get('/cashier', [CashierDashboardController::class, 'index'])
    ->middleware('can:has-role,"cashier","Only Cashiers can access this page."')
    ->name('cashier.dashboard');

Route::get('/waiter', [WaiterDashboardController::class, 'index'])
    ->middleware('can:has-role,"waiter","Only Waiters can access this page."')
    ->name('waiter.dashboard');

Route::get('/chef', [ChefDashboardController::class, 'index'])
    ->middleware('can:has-role,"chef","Only Chefs can access this page."')
    ->name('chef.dashboard');

// Admin management routes
// Grouping all routes have prefix '/admin', nama rute 'admin.',
// and middleware otorization 'can:has-role,"admin",...'
Route::middleware('can:has-role,"admin","Only Admins can access this page."')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Route: /admin (Nama: admin.dashboard)
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Route: /admin/menus (Nama: admin.menus)
        Route::resource('menus', MenuController::class);

        // Route: /admin/categories (Nama: admin.categories)
        Route::resource('categories', CategoryController::class)->except(['show']);

        // Route: /admin/users (Nama: admin.users)
        Route::get('/users', [UserController::class, 'index'])->name('users');

        // Route: /admin/reports (Nama: admin.reports)
        Route::get('/reports', [ReportController::class, 'index'])->name('reports');

        // Route: /admin/orders (Nama: admin.orders)
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    });