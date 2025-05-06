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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->from(100);
            $table->string('login')->unique()->comment('логин');
            $table->string('password')->comment('пароль');

            $table->string('name')->comment('имя');
            $table->string('surname')->comment('фамилия');
            $table->string('patronymic')->comment('отчество');
            $table->string('email')->unique()->comment('email');
            $table->string('phone')->comment('телефон');
            $table->date('birthday')->nullable()->comment('день рождения');

            $table->foreignId('department')->nullable()->comment('отдел');
            $table->foreignId('function')->nullable()->comment('должность');
            $table->timestamp('start_work')->nullable()->comment('трудоустройство');
            $table->foreignId('status')->nullable()->comment('статус');
            $table->timestamp('status_at')->comment('смена статуса');

            $table->json('permissions')->nullable()->comment('разрешения');
            $table->boolean('delete')->default(false);

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
