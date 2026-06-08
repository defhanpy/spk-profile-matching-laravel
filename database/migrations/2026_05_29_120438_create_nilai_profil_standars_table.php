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
        Schema::create('nilai_profil_standars', function (Blueprint $table) {

            $table->id();

            // relasi kriteria
            $table->unsignedBigInteger('kriteria_id');

            // relasi sub kriteria
            $table->unsignedBigInteger('sub_kriteria_id');

            // nilai standar
            $table->integer('nilai_profil_standar');

            $table->timestamps();

            // foreign key
            $table->foreign('kriteria_id')
                  ->references('id')
                  ->on('kriterias')
                  ->onDelete('cascade');

            $table->foreign('sub_kriteria_id')
                  ->references('id')
                  ->on('sub_kriterias')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_profil_standars');
    }
};