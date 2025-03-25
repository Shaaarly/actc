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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('price');
            $table->boolean('available');
            $table->int('bathrooms');
            $table->int('rooms');
            $table->boolean('keys');
            $table->boolean('remote');
            $table->unsignedBigInteger('property_type_id');
            $table->foreign('property_type_id')
                ->references('id')
                ->on('property_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
