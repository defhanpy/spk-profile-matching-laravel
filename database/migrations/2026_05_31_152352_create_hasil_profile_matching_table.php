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
    Schema::create('hasil_profile_matching', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('mahasiswa_id');
    $table->string('nama');

    $table->decimal('ncf', 10, 2)->default(0);
    $table->decimal('nsf', 10, 2)->default(0);
    $table->decimal('total', 10, 2)->default(0);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_profile_matching');
    }
};
