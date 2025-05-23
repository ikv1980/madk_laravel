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
        Schema::create('car_mark_model_countries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mark_id')->constrained('car_marks')->onDelete('cascade');
            $table->foreignId('model_id')->constrained('car_models')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('car_countries')->onDelete('cascade');

            // Уникальность на тройку: mark_id, model_id, country_id
            $table->unique(['mark_id', 'model_id', 'country_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_mark_model_countries', function (Blueprint $table) {
            $table->dropForeign(['mark_id']);
            $table->dropForeign(['model_id']);
            $table->dropForeign(['country_id']);
        });

        Schema::dropIfExists('car_mark_model_countries');
    }
};
