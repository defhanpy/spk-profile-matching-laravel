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
        Schema::create('sub_kriterias', function (Blueprint $table) {

            $table->id();

            // foreign key ke tabel kriterias
            $table->unsignedBigInteger('kriteria_id');

            // sub kriteria
            $table->string('sub_kriteria');

            // nilai
            $table->integer('nilai');

            $table->timestamps();

            // relasi foreign key
            $table->foreign('kriteria_id')
                  ->references('id')
                  ->on('kriterias')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_kriterias');
    }
};