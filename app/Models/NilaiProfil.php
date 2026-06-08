<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiProfil extends Model
{
    protected $table = 'nilai_profil';
    protected $primaryKey = 'id_nilai';

    public $timestamps = true;

    protected $fillable = [
        'alternatif_id',
        'kriteria_id',
        'sub_kriteria_id',
        'nilai'
    ];

    // Relasi ke alternatif
    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id', 'id_mhs');
    }

    // Relasi ke kriteria
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id', 'id');
    }

    // Relasi ke sub kriteria
    public function subKriteria()
    {
        return $this->belongsTo(SubKriteria::class, 'sub_kriteria_id', 'id');
    }
}
