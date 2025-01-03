<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class PassportServiceProvider extends ServiceProvider
{
  public function boot(): void
  {
    Passport::tokensExpireIn(now()->addMinutes(60));
    Passport::refreshTokensExpireIn(now()->addDays(30));
    Passport::personalAccessTokensExpireIn(now()->addYear());
    Passport::enablePasswordGrant();
  }
}
