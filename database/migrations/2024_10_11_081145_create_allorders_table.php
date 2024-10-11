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
        Schema::create('allorders', function (Blueprint $table) {
            $table->id(); // Primary key (id)
            $table->string('order_id')->unique(); // Separate Order ID, making it unique
            $table->string('customer_name'); // Customer Name
            $table->date('order_date'); // Date
            $table->decimal('total_amount', 8, 2); // Total Amount with precision
            $table->string('status'); // Status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allorders');
    }
};
