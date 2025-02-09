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
        Schema::create('personal_biodatas', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('user_id')->constrained();
            $table->string('npwp', 16)->unique();
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('address');
            $table->enum('gender', ['L', 'P']);
            $table->string('phone_number', 12);
            $table->string('religion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_biodatas');
    }
};
