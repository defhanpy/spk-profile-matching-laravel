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
        Schema::create('hasil_profile_matching_detail', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('hasil_id');

    $table->unsignedBigInteger('kriteria_id');
    $table->string('nama_kriteria');

    $table->integer('nilai_mhs')->nullable();
    $table->integer('nilai_std')->nullable();
    $table->integer('gap')->nullable();
    $table->float('nilai_gap')->nullable();

    $table->string('jenis'); // Core / Secondary

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_profile_matching_detail');
    }
};