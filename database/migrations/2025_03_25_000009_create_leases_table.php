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
        Schema::create('leases', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('start_lease');
            $table->date('ending_lease')->nullable();
            $table->boolean('keys_returned');
            $table->boolean('remote_returned');
            $table->boolean('active');
            $table->boolean('renewal');
            $table->unsignedSmallInteger('value');
            $table->softDeletes();
            
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');

            $table->unsignedBigInteger('payment_type_id');
            $table->foreign('payment_type_id')
                ->references('id')
                ->on('payment_types')
                ->onDelete('cascade');

                $table->foreignId('original_lease_id')
                ->nullable()
                ->constrained('leases')
                ->nullOnDelete();

            $table->unique(['client_id', 'property_id', 'start_lease']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leases');
    }
};
