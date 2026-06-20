<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiProfil;
use App\Models\ProfilStandar;

class DashboardController extends Controller
{
    private $bobotGap = [
        0 => 5,
        1 => 4.5,
        -1 => 4,
        2 => 3.5,
        -2 => 3,
        3 => 2.5,
        -3 => 2,
        4 => 1.5,
        -4 => 1
    ];

    public function index()
    {
        // Jumlah data
        $jumlahAlternatif = Alternatif::count();
        $jumlahKriteria = Kriteria::count();
        $jumlahKriteriaCore = Kriteria::where('jenis_kriteria', 'Core')->count();
        $jumlahKriteriaSecondary = Kriteria::where('jenis_kriteria', 'Secondary')->count();

        // Ambil data untuk kalkulasi peringkat PM secara real-time
        $alternatif = Alternatif::with(['nilaiProfil'])->get();
        $standar = ProfilStandar::all()->keyBy('kriteria_id');
        $kriteriaList = Kriteria::all()->keyBy('id');

        $hasil = [];
        foreach ($alternatif as $alt) {
            $coreValues = [];
            $secondaryValues = [];

            foreach ($alt->nilaiProfil as $nilai) {
                $kriteriaId = $nilai->kriteria_id;
                $nilaiMhs = $nilai->nilai;
                $nilaiStd = isset($standar[$kriteriaId]) ? $standar[$kriteriaId]->nilai : 5;

                $gap = $nilaiMhs - $nilaiStd;
                $bobot = $this->bobotGap[$gap] ?? 0;

                $jenisKriteria = isset($kriteriaList[$kriteriaId])
                    ? $kriteriaList[$kriteriaId]->jenis_kriteria
                    : 'Secondary';

                $isCore = (strtolower($jenisKriteria) == 'core');

                if ($isCore) {
                    $coreValues[] = $bobot;
                } else {
                    $secondaryValues[] = $bobot;
                }
            }

            $ncf = !empty($coreValues) ? array_sum($coreValues) / count($coreValues) : 0;
            $nsf = !empty($secondaryValues) ? array_sum($secondaryValues) / count($secondaryValues) : 0;
            $total = (0.6 * $ncf) + (0.4 * $nsf);

            $hasil[] = (object) [
                'nama' => $alt->nama,
                'nim' => $alt->nim,
                'total' => round($total, 2),
                'rata_rata' => round($total, 2), // Tetap pertahankan nama properti ini agar kompatibel dengan View
            ];
        }

        // Urutkan berdasarkan total skor terbesar
        usort($hasil, function($a, $b) {
            return $b->total <=> $a->total;
        });

        $hasilCollection = collect($hasil);
        $rankingTerbaik = $hasilCollection->first();
        $topFive = $hasilCollection->take(5)->values();

        // Data untuk chart (opsional)
        $chartData = [
            'labels' => ['Core Factor', 'Secondary Factor'],
            'data' => [$jumlahKriteriaCore, $jumlahKriteriaSecondary],
        ];

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

