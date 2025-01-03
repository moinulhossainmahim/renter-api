<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LogInController;
use App\Http\Controllers\Auth\RefreshTokenController;
use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Auth\LogOutController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\WishlistController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [LogInController::class, '__invoke']);
    Route::post('register', [RegisterController::class, '__invoke']);
    Route::post('refresh', [RefreshTokenController::class, '__invoke']);

    Route::middleware('authenticate')->group(function () {
        Route::post('me', [MeController::class, '__invoke']);
        Route::delete('logout', [LogOutController::class, '__invoke']);
        Route::put('change-password', [ChangePasswordController::class, '__invoke']);
    });
});

Route::group(['prefix' => 'listing'], function () {
  Route::get('list', [ListingController::class, 'index']);
    Route::middleware('authenticate')->group(function () {
      Route::post('store', [ListingController::class, 'store']);
      Route::group(['prefix' => '{listing}'], function () {
        Route::delete('delete', [ListingController::class, 'destroy']);
      });
    });
});

Route::group(['prefix' => 'wishlist'], function () {
  Route::get('list', [WishlistController::class, 'index']);
  Route::middleware('authenticate')->group(function () {
    Route::post('store', [WishlistController::class, 'store']);
    Route::group(['prefix' => '{wishlist}'], function () {
      Route::post('delete', [WishlistController::class, 'destroy']);
    });
  });
});
