<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $title = 'Dashboard';
    return view('welcome', compact('title'));
})->middleware('auth')->name('dashboard');

Route::prefix('master-data')->name('master-data.')->middleware('auth')->group(function () {
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('account', AccountController::class);
    Route::resource('candidates', CandidateController::class);
});

require __DIR__ . '/auth.php';
