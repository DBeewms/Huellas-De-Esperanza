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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_type_id');
            $table->string('name');
            $table->string('breed');
            $table->enum('sex', ['male', 'female']);
            $table->date('dob'); // Date of Birth
            $table->string('photo')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'waiting', 'adopted'])->default('available'); // Updated status field
            $table->timestamps();
            $table->foreign('pet_type_id')->references('id')->on('pet_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};

