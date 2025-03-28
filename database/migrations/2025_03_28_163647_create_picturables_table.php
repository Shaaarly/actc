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
        Schema::create('picturables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('picture_id');
            $table->unsignedBigInteger('picturable_id');
            $table->string('picturable_type');
            $table->timestamps();

            $table->foreign('picture_id')
                ->references('id')
                ->on('pictures')
                ->onDelete('cascade');

            $table->unique(['picture_id', 'picturable_id', 'picturable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('picturables');
    }
};
