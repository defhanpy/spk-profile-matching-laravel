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
        Schema::create('profil_standars', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel kriteria
            $table->foreignId('kriteria_id')
                  ->constrained('kriterias')
                  ->onDelete('cascade');

            // Relasi ke tabel sub_kriterias
            $table->foreignId('sub_kriteria_id')
                  ->constrained('sub_kriterias')
                  ->onDelete('cascade');

            // Nilai profil standar
            $table->integer('nilai');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_standars');
    }
};