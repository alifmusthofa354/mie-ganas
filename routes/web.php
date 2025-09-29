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