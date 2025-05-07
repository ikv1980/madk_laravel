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
        Schema::table('users', function (Blueprint $table) {
            // Внешние ключи
            $table->foreign('department_id')->references('id')->on('user_departments')->onDelete('set null');
            $table->foreign('position_id')->references('id')->on('user_positions')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('user_statuses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['position_id']);
            $table->dropForeign(['status_id']);
        });

        Schema::dropIfExists('users');
    }
};
