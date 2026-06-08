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
        Schema::create('nilai_profil', function (Blueprint $table) {
    $table->id('id_nilai');

    // FIX karena PK alternatifs = id_mhs
    $table->unsignedBigInteger('alternatif_id');
    $table->unsignedBigInteger('kriteria_id');
    $table->unsignedBigInteger('sub_kriteria_id');

    $table->decimal('nilai', 8, 2);

    $table->timestamps();

    // FOREIGN KEY MANUAL (WAJIB)
    $table->foreign('alternatif_id')
        ->references('id_mhs')
        ->on('alternatifs')
        ->onDelete('cascade');

    $table->foreign('kriteria_id')
        ->references('id')
        ->on('kriterias')
        ->onDelete('cascade');

    $table->foreign('sub_kriteria_id')
        ->references('id')
        ->on('sub_kriteria')
        ->onDelete('cascade');

    $table->unique(['alternatif_id', 'kriteria_id']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_profil');
    }
};