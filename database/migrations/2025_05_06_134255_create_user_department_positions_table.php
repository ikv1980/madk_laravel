<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_department_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('user_departments')->onDelete('cascade');
            $table->foreignId('position_id')->constrained('user_positions')->onDelete('cascade');

            // Уникальность на двойку: department_id, position_id
            $table->unique(['department_id', 'position_id']);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_department_positions');
    }
};
