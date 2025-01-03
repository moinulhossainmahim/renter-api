<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  public function boot(): void
  {
    $this->app->register(PassportServiceProvider::class);
    $this->app->register(MiddlewareServiceProvider::class);
    $this->app->register(SwaggerServiceProvider::class);
  }
}
