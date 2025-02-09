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
        Schema::create('employee_details', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('user_id')->constrained();
            $table->string('nip', 18)->unique();
            $table->string('group', 5);
            $table->enum('echelon', ['I', 'II', 'III', 'IV', 'V']);
            $table->string('position');
            $table->string('office_location');
            $table->string('department');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_details');
    }
};
