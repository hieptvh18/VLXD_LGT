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
        Schema::create('categoryables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->morphs('categoryable'); // Tạo cột `taggable_id` và `taggable_type`
            $table->timestamps();
        });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoryables');
    }
};
