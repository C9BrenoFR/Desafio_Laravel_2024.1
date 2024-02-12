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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->date('bdate');
            $table->string('adress', 255);
            $table->string('phone', 255);
            $table->string('cpf', 255);
            $table->string('pfp', 255);
            $table->enum('period', ['00h-06h', '06h-12h', '12h-18h', '18h-00h']);
            $table->string('crm');
            $table->unsignedBigInteger('specialty_id');
            $table->timestamps();

            $table->foreign('specialty_id')->references('id')->on('specialties');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
