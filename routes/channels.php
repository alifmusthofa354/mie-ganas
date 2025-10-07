<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Anda dapat menggunakan ini untuk otorisasi dasar channel 'User'
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Dan pastikan channel 'admin.orders' Anda yang sebelumnya didefinisikan juga ada di sini:
Broadcast::channel('admin.orders', function ($user) {
    // Cek apakah user terotentikasi dan memiliki role admin
    return $user && $user->role === 'admin';
});