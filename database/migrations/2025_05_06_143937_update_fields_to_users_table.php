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
            $table->foreign('department')->references('id')->on('user_departments')->onDelete('set null');
            $table->foreign('function')->references('id')->on('user_functions')->onDelete('set null');
            $table->foreign('status')->references('id')->on('user_statuses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department']);
            $table->dropForeign(['function']);
            $table->dropForeign(['status']);
        });
    }
};
