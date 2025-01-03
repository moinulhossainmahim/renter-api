<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('wishlists', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlId('user_id');
      $table->foreignUlid('listing_id');
      $table->unique(['user_id', 'listing_id']);
      $table->softDeletes();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('wishlists');
  }
};
