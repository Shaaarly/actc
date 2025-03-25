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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('status', ['completed', 'sleeping', 'pending'])->default('pending');
            $table->int('value');
            $table->text('description');
            $table->unsignedBigInteger('payment_type_id');
            $table->foreign('payment_type_id')
                ->references('id')
                ->on('payment_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
