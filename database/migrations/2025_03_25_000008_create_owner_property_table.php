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
        Schema::create('owner_property', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('property_id');
            $table->timestamps();

            $table->foreign('owner_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');

            $table->unique(['owner_id', 'property_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_property');
    }
};
