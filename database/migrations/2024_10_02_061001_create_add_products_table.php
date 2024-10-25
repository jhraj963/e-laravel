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
        Schema::create('add_products', function (Blueprint $table) {
            $table->id();
            $table->string('productname');
            $table->string('description');
            $table->decimal('price', 6, 2)->nullable();
            $table->decimal('quantity', 6)->nullable();
            $table->string('category_id');
            $table->string('photo');
            $table->string('is_featured');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_products');
    }
};
