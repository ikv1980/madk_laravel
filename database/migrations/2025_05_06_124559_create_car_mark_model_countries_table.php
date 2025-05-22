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
        Schema::create('car_mark_model_countries', function (Blueprint $table) {
            $table->id();

            // Внешние ключи
            $table->unsignedBigInteger('mark_id');
            $table->unsignedBigInteger('model_id');
            $table->unsignedBigInteger('country_id');

            // Уникальность на тройку: mark_id, model_id, country_id
            $table->unique(['mark_id', 'model_id', 'country_id']);

            // Индексы для ускорения запросов
            $table->index(['mark_id', 'model_id']);
            $table->index(['mark_id', 'country_id']);
            $table->index(['model_id', 'country_id']);

            // Внешние ключи
            $table->foreign('mark_id')->references('id')->on('car_marks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('model_id')->references('id')->on('car_models')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')->on('car_countries')->onDelete('cascade')->onUpdate('cascade');

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
