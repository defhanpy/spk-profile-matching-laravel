<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    protected $table = 'sub_kriterias';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kriteria_id',
        'sub_kriteria',
        'nilai',
        'min',
        'max'
    ];

    public $timestamps = true;

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id', 'id');
    }

    public function nilaiProfil()
    {
        return $this->hasMany(NilaiProfil::class, 'sub_kriteria_id', 'id');
    }
}
