<?php

use Illuminate\Support\Facades\Route;

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

// Dashboard routes
Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/cashier', function () {
    return view('cashier.dashboard');
})->name('cashier.dashboard');

Route::get('/waiter', function () {
    return view('waiter.dashboard');
})->name('waiter.dashboard');

Route::get('/chef', function () {
    return view('chef.dashboard');
})->name('chef.dashboard');