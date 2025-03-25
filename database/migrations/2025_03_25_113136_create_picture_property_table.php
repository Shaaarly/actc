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
        Schema::create('picture_property', function (Blueprint $table) {
            $table->id(); // Columna autoincremental
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('picture_id');
            $table->timestamps();

            // Definición de las claves foráneas
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');

            $table->foreign('picture_id')
                ->references('id')
                ->on('pictures')
                ->onDelete('cascade');

            $table->unique(['property_id', 'picture_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('picture_property');
    }
};
