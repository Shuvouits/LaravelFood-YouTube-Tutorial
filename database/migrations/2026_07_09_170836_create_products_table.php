<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
             $table->id();
            $table->string('image')->nullable(); // Thumbnail image path
            $table->string('product_name');
            $table->string('slug')->unique();
            $table->string('product_category'); // Simple or Classified
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('offer_price', 10, 2)->nullable();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable(); // From editor
            $table->enum('today_special', ['yes', 'no'])->default('no');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
