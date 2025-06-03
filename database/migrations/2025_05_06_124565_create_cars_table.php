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
            $table->id();
            // Вторичные ключи
            $table->foreignId('mark_id')->constrained('car_marks')->onDelete('cascade');
            $table->foreignId('model_id')->constrained('car_models')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('car_countries')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('car_types')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('car_colors')->onDelete('cascade');

            $table->string('vin', 20)->unique()->comment('VIN');
            $table->string('pts', 20)->unique()->comment('PTS');
            $table->date('date_at')->comment('дата производства');
            $table->decimal('price', 10, 2)->comment('цена');
            $table->unsignedBigInteger('block')->comment('блок');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['mark_model_country_id']);
            $table->dropForeign(['type_id']);
            $table->dropForeign(['color_id']);
        });

        Schema::dropIfExists('cars');
    }
};
