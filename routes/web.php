<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $title = 'Dashboard';
    return view('welcome', compact('title'));
})->name('dashboard');

Route::prefix('master-data')->name('master-data.')->group(function () {
    Route::resource('permissions', PermissionController::class);
});

require __DIR__ . '/auth.php';
