<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilStandar extends Model
{
    protected $fillable = [
        'kriteria_id',
        'sub_kriteria_id',
        'nilai',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function subKriteria()
    {
        return $this->belongsTo(SubKriteria::class);
    }
}
