<?php

namespace Database\Seeders;

use App\Models\Wishlist;

class WishlistSeeder extends Seeder
{
  public function run(): void
  {
    Wishlist::factory(50)->create();
  }
}
