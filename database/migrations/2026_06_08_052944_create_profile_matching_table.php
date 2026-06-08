<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_matching', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kriteria_id');
            $table->unsignedBigInteger('sub_kriteria_id');
            $table->decimal('nilai', 5, 2);
            $table->timestamps();

            // Foreign keys
            $table->foreign('kriteria_id')->references('kriteria_id')->on('kriteria');
            $table->foreign('sub_kriteria_id')->references('sub_kriteria_id')->on('sub_kriteria');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_matching');
    }
};
