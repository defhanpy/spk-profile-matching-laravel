<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'jenis_kriteria',
    ];

    public $timestamps = true;

    // Relasi ke sub kriteria
    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class, 'kriteria_id', 'id');
    }

    // Relasi ke nilai profil
    public function nilaiProfil()
    {
        return $this->hasMany(NilaiProfil::class, 'kriteria_id', 'id');
    }
}
