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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('addressable_id');
            $table->string('addressable_type');
            $table->string('street_name');
            $table->string('passageway')->nullable();
            $table->unsignedInteger('postal_code');
            $table->string('province');
            $table->unsignedTinyInteger('entrance_number');
            $table->char('block')->nullable();
            $table->unsignedTinyInteger('floor')->nullable();
            $table->unsignedTinyInteger('apartment_number');
            $table->string('city');
            $table->string('country');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['addressable_id', 'addressable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
