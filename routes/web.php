<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\CheckPermission;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view(uri: '/', view: 'dashboard')->name(name: 'dashboard');

    Route::prefix('profiles')->name('profiles.')->controller(ProfileController::class)->group(function () {
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
        Route::get('/{id}/permissions', 'editPermissions')
            ->name('permissions.edit')
            ->middleware(CheckPermission::class . ':profile.permissions.edit');
        Route::put('/{id}/permissions', 'updatePermissions')
            ->name('permissions.update')
            ->middleware(CheckPermission::class . ':profile.permissions.update');
        Route::delete('/{id}/destroy', 'destroy')
            ->name('destroy')
            ->middleware(CheckPermission::class . ':profile.destroy');
    });

    Route::prefix('permissions')->name('permissions.')->controller(PermissionController::class)->group(function () {
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
        Route::delete('/{id}/destroy', 'destroy')
            ->name('destroy')
            ->middleware(CheckPermission::class . ':permission.destroy');
    });

    Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')
            ->name('index')
            ->middleware(CheckPermission::class . ':user.index');
        Route::get('/create', 'create')
            ->name('create')
            ->middleware(CheckPermission::class . ':user.create');
        Route::post('/store', 'store')
            ->name('store')
            ->middleware(CheckPermission::class . ':user.store');
        Route::get('/{id}/edit', 'edit')
            ->name('edit')
            ->middleware(CheckPermission::class . ':user.edit');
        Route::put('/{id}/update', 'update')
            ->name('update')
            ->middleware(CheckPermission::class . ':user.update');
        Route::get('/{id}/profiles', 'editProfiles')
            ->name('profiles.edit')
            ->middleware(CheckPermission::class . ':user.profiles.edit');
        Route::put('/{id}/profiles', 'updateProfiles')
            ->name('profiles.update')
            ->middleware(CheckPermission::class . ':user.profiles.update');
        Route::delete('/{id}/destroy', 'destroy')
            ->name('destroy')
            ->middleware(CheckPermission::class . ':user.destroy');
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
