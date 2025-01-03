<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\Wishlist;
use App\Models\User;

class WishlistFactory extends Factory
{
  protected $model = Wishlist::class;

  public function definition(): array
  {
    return [
      'listing_id' => Listing::inRandomOrder()->first()?->id,
      'user_id' => User::inRandomOrder()->first()?->id,
    ];
  }
}
