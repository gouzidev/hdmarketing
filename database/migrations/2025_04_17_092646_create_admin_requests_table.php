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
        Schema::create('admin_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->
                nullable()->
                constrained('users')->
                nullOnDelete()->
                cascadeOnUpdate();

            $table->foreignId('user_id')->
                constrained('users')->
                cascadeOnDelete();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamp('processed_at')->nullable()->default(NULL);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_requests');
    }
};
