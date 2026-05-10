<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $title = 'Dashboard';
    return view('welcome', compact('title'));
});

require __DIR__ . '/auth.php';
