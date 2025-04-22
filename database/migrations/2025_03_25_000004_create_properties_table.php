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
            $table->integer('price');
            $table->integer('number')->nullable();
            $table->char('letter')->nullable();
            $table->string('description');
            $table->string('cadastre')->nullable();
            $table->boolean('available');
            $table->boolean('ocupied');
            $table->integer('area')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('rooms')->nullable();
            $table->boolean('keys');
            $table->boolean('remote');
            $table->softDeletes();
            
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
