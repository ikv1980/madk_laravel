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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->unique()->comment('');;
            $table->string('client_mail')->unique()->comment('');;
            $table->string('client_phone')->unique()->comment('');;
            $table->string('client_address')->nullable()->comment('');
            $table->text('client_add_data')->nullable()->comment('');;
            $table->boolean('client_status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
