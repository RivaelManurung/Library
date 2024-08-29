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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul Buku
            $table->foreignId('categories_id')->constrained()->onDelete('cascade'); // Kategori Buku
            $table->text('description'); // Deskripsi
            $table->integer('quantity'); // Jumlah
            $table->string('file_path')->nullable();
            $table->string('cover_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
