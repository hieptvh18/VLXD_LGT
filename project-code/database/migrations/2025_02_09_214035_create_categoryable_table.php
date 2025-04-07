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
        Schema::create('item_categoryable', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('item_categoryable_type');
            $table->unsignedBigInteger('item_categoryable_id');
            $table->index(['item_categoryable_type', 'item_categoryable_id'], 'idx_item_categoryable'); // Tên ngắn hơn
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_categoryable');
    }
};
