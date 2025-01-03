<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\User;

class ListingFactory extends Factory
{
  protected $model = Listing::class;

  public function definition(): array
  {
    return [
      'user_id' => User::inRandomOrder()->first()?->id,
      'title' => $this->faker->words(3, true),
      'description' => $this->faker->text(255),
      'price' => $this->faker->numberBetween(5000, 50000),
      'street_address' => $this->faker->streetAddress(),
      'city' => $this->faker->city(),
      'state' => $this->faker->state(),
      'postal_code' => $this->faker->postcode(),
      'latitude' => $this->faker->latitude(-90, 90),
      'longitude' => $this->faker->longitude(-180, 180),
      'images' => [$this->faker->imageUrl(), $this->faker->imageUrl()],
      'features' => $this->faker->randomElements(
        ['Balcony', 'Wifi', 'Kitchen', 'Parking', 'Elevator', 'CCTV Camera'],
        $this->faker->numberBetween(2, 5),
      ),
    ];
  }
}
