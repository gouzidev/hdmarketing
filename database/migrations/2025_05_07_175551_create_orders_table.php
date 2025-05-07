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
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained('products', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('shipping_id')->constrained('shippings', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('count')->default(1);
            $table->unsignedInteger('sell-price');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->tinyText('country');
            $table->tinyText('city');
            $table->tinyText('zip')->nullable();
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
