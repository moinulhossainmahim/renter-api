<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['user_id', 'listing_id'];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function listing(): BelongsTo
  {
    return $this->belongsTo(Listing::class);
  }
}
