<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('sub_kriterias', function (Blueprint $table) {
        $table->decimal('min', 5, 2)->nullable();
        $table->decimal('max', 5, 2)->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_kriteria', function (Blueprint $table) {
            //
        });
    }
};
