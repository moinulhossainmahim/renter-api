<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'user_id',
    'title',
    'description',
    'price',
    'street_address',
    'city',
    'state',
    'postal_code',
    'country',
    'latitude',
    'longitude',
    'images',
    'features',
  ];

  protected function casts(): array
  {
    return [
      'features' => 'array',
      'images' => 'array',
    ];
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
