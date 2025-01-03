<?php

namespace Database\Seeders;

use App\Models\User;

class UserSeeder extends Seeder
{
  public function run(): void
  {
    User::factory(50)->create();
  }
}
