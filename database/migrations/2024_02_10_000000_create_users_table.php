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
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->date('bdate');
            $table->string('adress', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('cpf', 255)->nullable();
            $table->string('abo', 255)->nullable();
            $table->string('pfp', 255)->nullable();
            $table->boolean('fst_login')->default(false);
            $table->unsignedBigInteger('healthp_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('healthp_id')->references('id')->on('health_plans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
