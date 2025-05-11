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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affiliate_id')->constrained('users', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained('products', 'id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedInteger('affiliate_price');

            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->foreignId('shipping_id')->constrained('shippings', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('address');
            $table->tinyText('zip')->nullable();
            $table->enum('shipping_status', ['pending', 'shipped', 'delivered'])->default('pending');
            
            $table->dateTime('payment_date')->nullable();
            $table->dateTime('shipping_date')->nullable();
            $table->enum('payment_status',  ['pending', 'paid'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
