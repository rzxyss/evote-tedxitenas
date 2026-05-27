<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/vote/{id}', [DashboardController::class, 'vote'])->name('vote');
});

Route::prefix('master-data')->name('master-data.')->middleware('auth')->group(function () {
    Route::post('/account/import', [AccountController::class, 'import'])->name('account.import');
    Route::get('/account/download-template', [AccountController::class, 'download'])->name('account.download-template');
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('account', AccountController::class);
    Route::resource('candidates', CandidateController::class);
});

require __DIR__ . '/auth.php';
