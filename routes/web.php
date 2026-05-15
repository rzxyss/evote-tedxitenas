<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $title = 'Dashboard';
    return view('welcome', compact('title'));
})->name('dashboard');

Route::prefix('master-data')->name('master-data.')->group(function () {
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
});

require __DIR__ . '/auth.php';
