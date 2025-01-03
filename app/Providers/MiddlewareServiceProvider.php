<?php

namespace App\Providers;

use App\Http\Middleware\AuthenticateMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
{
  public function boot()
  {
    Route::aliasMiddleware('authenticate', AuthenticateMiddleware::class);
  }
}
