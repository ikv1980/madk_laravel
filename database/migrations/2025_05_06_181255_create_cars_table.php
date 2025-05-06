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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mark')->comment('марка');
            $table->foreignId('model')->comment('модель');
            $table->foreignId('country')->comment('страна');
            $table->foreignId('type')->comment('тип кузова');
            $table->foreignId('color')->comment('цвет кузова');

            $table->string('vin', 20 )->comment('VIN');
            $table->string('pts', 20 )->comment('PTS');
            $table->date('date_at')->comment('дата производства');
            $table->decimal('price', 10, 2)->comment('цена');

            $table->boolean('block')->comment('блок');
            $table->boolean('delete')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
