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
        Schema::create('alternatifs', function (Blueprint $table) {
            $table->id('id_mhs');

            $table->string('nim')->unique();
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            $table->string('no_hp');
            $table->string('email')->unique();
            $table->text('alamat');

            $table->string('prodi');
            $table->string('fakultas');

            $table->year('angkatan');
            $table->integer('semester');

            $table->decimal('ipk', 3, 2);

            $table->bigInteger('penghasilan_orang_tua');

            $table->integer('jumlah_tanggungan');

            $table->string('status')->default('Aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternatifs');
    }
};
