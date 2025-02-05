<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\CheckPermission;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view(uri: '/', view: 'dashboard')->name(name: 'dashboard');

    Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'index')
            ->name('index')
            ->middleware(CheckPermission::class . ':profile.index');
        Route::get('/create', 'create')
            ->name('create')
            ->middleware(CheckPermission::class . ':profile.create');
        Route::post('/store', 'store')
            ->name('store')
            ->middleware(CheckPermission::class . ':profile.store');
        Route::get('/{id}/edit', 'edit')
            ->name('edit')
            ->middleware(CheckPermission::class . ':profile.edit');
        Route::put('/{id}/update', 'update')
            ->name('update')
            ->middleware(CheckPermission::class . ':profile.update');
        Route::delete('/', 'destroy')
            ->name('destroy')
            ->middleware(CheckPermission::class . ':profile.destroy');
    });

    Route::prefix('permission')->name('permission.')->controller(PermissionController::class)->group(function () {
        Route::get('/', 'index')
            ->name('index')
            ->middleware(CheckPermission::class . ':permission.index');
        Route::get('/create', 'create')
            ->name('create')
            ->middleware(CheckPermission::class . ':permission.create');
        Route::post('/store', 'store')
            ->name('store')
            ->middleware(CheckPermission::class . ':permission.store');
        Route::get('/{id}/edit', 'edit')
            ->name('edit')
            ->middleware(CheckPermission::class . ':permission.edit');
        Route::put('/{id}/update', 'update')
            ->name('update')
            ->middleware(CheckPermission::class . ':permission.update');
        Route::delete('/', 'destroy')
            ->name('destroy')
            ->middleware(CheckPermission::class . ':permission.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('user/profile')->name('user.profile.')->controller(UserProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });
});

require __DIR__.'/auth.php';
