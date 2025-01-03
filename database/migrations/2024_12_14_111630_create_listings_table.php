<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('listings', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlId('user_id');
      $table->string('title', 55);
      $table->string('description', 255);
      $table->integer('price');
      $table->string('street_address', 255);
      $table->string('city', 100);
      $table->string('state', 100);
      $table->string('postal_code', 20);
      $table->string('country', 100)->default('Bangladesh');
      $table->decimal('latitude', 10, 8)->nullable();
      $table->decimal('longitude', 11, 8)->nullable();
      $table->longText('images')->nullable();
      $table->longText('features')->nullable();
      $table->integer('bedrooms')->default(0);
			$table->integer('bathrooms')->default(0);
      $table->softDeletes();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('listings');
  }
};
