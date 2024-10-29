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
            $table->id(); // Primary key (Order ID)
            $table->unsignedBigInteger('customer_id'); // Customer ID
            $table->string('customer_name'); // Customer Name
            $table->date('order_date'); // Order Date
            $table->decimal('total_amount', 8, 2); // Total Amount
            $table->string('email'); // Email
            $table->string('mobile_no'); // Mobile No
            $table->text('address'); // Address
            $table->string('country'); // Country
            $table->string('city'); // City
            $table->string('state'); // State
            $table->string('zip_code'); // ZIP Code
            $table->decimal('discount', 8, 2)->nullable(); // Discount
            $table->decimal('shipping_charge', 8, 2)->nullable(); // Shipping Charge
            $table->date('shipping_date')->nullable(); // Shipping Date
            $table->unsignedBigInteger('shipping_method_id'); // Shipping Method ID
            $table->string('status')->default('pending'); // Order Status (default: pending)
            $table->string('total_qty');
            $table->string('cart_data');
            $table->string('coupon_code');
            $table->string('payment_method');
            $table->string('transaction_id');
            $table->string('notes');
            $table->string('cancel_request');
            $table->timestamps();
            // Foreign Key constraint for customer_id and shipping_method_id
            // $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            // $table->foreign('shipping_method_id')->references('id')->on('shipping_methods')->onDelete('cascade');
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
