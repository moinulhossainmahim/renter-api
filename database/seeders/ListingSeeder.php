<?php

namespace Database\Seeders;

use App\Models\Listing;

class ListingSeeder extends Seeder
{
  public function run(): void
  {
    Listing::factory(50)->create();
  }
}
