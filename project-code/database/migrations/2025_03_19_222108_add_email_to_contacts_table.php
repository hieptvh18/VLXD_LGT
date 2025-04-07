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
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('email')->nullable()->after('phone');
            $table->unsignedBigInteger('item_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            if (Schema::hasColumn('contacts', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('contacts', 'item_id')) {
                $table->dropColumn('item_id');
            }
        });
    }
};
