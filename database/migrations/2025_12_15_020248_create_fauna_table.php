<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fauna', function (Blueprint $table) {
            $table->id();
            $table->string('name');                   // Nama fauna
            $table->string('scientific_name');        // Nama ilmiah
            $table->string('family')->nullable();     // Famili
            $table->string('habitat')->nullable();    // Habitat
            $table->text('description')->nullable();  // Deskripsi
            $table->string('status')->nullable();     // Status konservasi
            $table->string('image_path')->nullable(); // Path gambar
            $table->boolean('is_approved')->nullable();// Status persetujuan
            $table->foreignId('created_by')->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fauna');
    }
};
