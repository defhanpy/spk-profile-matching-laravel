<?php
// app/Models/ProfileMatching.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileMatching extends Model
{
    use HasFactory;

    protected $table = 'profile_matching';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'kriteria_id',
        'sub_kriteria_id',
        'nilai',
        'created_at',
        'updated_at'
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id', 'kriteria_id');
    }

    public function subKriteria()
    {
        return $this->belongsTo(SubKriteria::class, 'sub_kriteria_id', 'sub_kriteria_id');
    }
}
