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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // e.g. "Stroller", "Car Seat"
            $table->string('slug')->unique();
            $table->string('icon')->nullable(); // emoji atau nama icon
            $table->timestamps();
        });
         Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('brand')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price_per_day', 10, 2);   // harga sewa per hari
            $table->integer('stock')->default(1);       // jumlah unit tersedia
            $table->integer('min_age_month')->nullable(); // usia min bayi (bulan)
            $table->integer('max_age_month')->nullable(); // usia max bayi (bulan)
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};
