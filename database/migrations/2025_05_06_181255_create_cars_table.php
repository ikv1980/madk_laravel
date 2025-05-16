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
        Schema::create('cars', function (Blueprint $table) {
            $table->id()->from(100);

            $table->foreignId('mark_id')->nullable()->comment('марка');
            $table->foreignId('model_id')->nullable()->comment('модель');
            $table->foreignId('country_id')->nullable()->comment('страна');
            $table->foreignId('type_id')->nullable()->comment('тип кузова');
            $table->foreignId('color_id')->nullable()->comment('цвет');

            $table->string('vin', 20)->unique()->comment('VIN');
            $table->string('pts', 20)->unique()->comment('PTS');
            $table->date('date_at')->comment('дата производства');
            $table->decimal('price', 10, 2)->comment('цена');
            $table->boolean('block')->comment('блок');
            $table->softDeletes();

            // Внешние ключи
            $table->foreign('mark_id')->references('id')->on('car_marks')->onDelete('set null');
            $table->foreign('model_id')->references('id')->on('car_models')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('car_countries')->onDelete('set null');
            $table->foreign('type_id')->references('id')->on('car_types')->onDelete('set null');
            $table->foreign('color_id')->references('id')->on('car_colors')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Удаляем внешние ключи
            $table->dropForeign(['mark_id']);
            $table->dropForeign(['model_id']);
            $table->dropForeign(['country_id']);
            $table->dropForeign(['type_id']);
            $table->dropForeign(['color_id']);
        });

        Schema::dropIfExists('cars');
    }
};
