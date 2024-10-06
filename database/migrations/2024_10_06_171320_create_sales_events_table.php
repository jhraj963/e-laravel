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
        Schema::create('sales_events', function (Blueprint $table) {
            $table->id();
            $table->string('eventname', 255)->nullable();
            $table->dateTime('startdate')->nullable();    // Add start date column
            $table->dateTime('enddate')->nullable();      // Add end date column
            $table->decimal('discount', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_events');
    }
};
