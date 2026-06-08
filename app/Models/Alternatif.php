<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $table = 'alternatifs';
    protected $primaryKey = 'id_mhs';

    protected $fillable = [
        'nim',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'no_hp',
        'email',
        'alamat',
        'prodi',
        'fakultas',
        'angkatan',
        'semester',
        'ipk',
        'penghasilan_orang_tua',
        'jumlah_tanggungan',
        'status'
    ];

    public $timestamps = true;

    // Relasi ke nilai profil
    public function nilaiProfil()
    {
        return $this->hasMany(NilaiProfil::class, 'alternatif_id', 'id_mhs');
    }
}
