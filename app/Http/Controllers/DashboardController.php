<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiProfil;

class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah data
        $jumlahAlternatif = Alternatif::count();
        $jumlahKriteria = Kriteria::count();
        $jumlahKriteriaCore = Kriteria::where('jenis_kriteria', 'Core')->count();
        $jumlahKriteriaSecondary = Kriteria::where('jenis_kriteria', 'Secondary')->count();

        // Ranking terbaik berdasarkan total nilai profil
        $rankingTerbaik = Alternatif::with(['nilaiProfil'])
            ->get()
            ->map(function ($alternatif) {
                $totalNilai = $alternatif->nilaiProfil->sum('nilai');
                $rataNilai = $alternatif->nilaiProfil->count() > 0
                    ? $totalNilai / $alternatif->nilaiProfil->count()
                    : 0;

                return (object) [
                    'nama' => $alternatif->nama,
                    'nim' => $alternatif->nim,
                    'total' => $totalNilai,
                    'rata_rata' => round($rataNilai, 2),
                ];
            })
            ->sortByDesc('rata_rata')
            ->first();

        // Data untuk chart (opsional)
        $chartData = [
            'labels' => ['Core Factor', 'Secondary Factor'],
            'data' => [$jumlahKriteriaCore, $jumlahKriteriaSecondary],
        ];

        // 5 besar peringkat
        $topFive = Alternatif::with(['nilaiProfil'])
            ->get()
            ->map(function ($alternatif) {
                $totalNilai = $alternatif->nilaiProfil->sum('nilai');
                $rataNilai = $alternatif->nilaiProfil->count() > 0
                    ? $totalNilai / $alternatif->nilaiProfil->count()
                    : 0;

                return (object) [
                    'id' => $alternatif->id_mhs,
                    'nama' => $alternatif->nama,
                    'nim' => $alternatif->nim,
                    'rata_rata' => round($rataNilai, 2),
                ];
            })
            ->sortByDesc('rata_rata')
            ->take(5)
            ->values();

        return view('dashboard', compact(
            'jumlahAlternatif',
            'jumlahKriteria',
            'jumlahKriteriaCore',
            'jumlahKriteriaSecondary',
            'rankingTerbaik',
            'chartData',
            'topFive'
        ));
    }
}
