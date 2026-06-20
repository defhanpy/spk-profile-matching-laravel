<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiProfil;
use App\Models\ProfilStandar;
use Illuminate\Http\Request;

class RankingController extends Controller
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
        $alternatif = Alternatif::all();
        $standar = ProfilStandar::all()->keyBy('kriteria_id');
        $kriteriaList = Kriteria::all()->keyBy('id');

        $hasil = [];

        foreach ($alternatif as $alt) {
            $nilaiProfils = NilaiProfil::where('alternatif_id', $alt->id_mhs)->get();

            $coreValues = [];
            $secondaryValues = [];

            foreach ($nilaiProfils as $nilai) {
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

            $hasil[] = [
                'alternatif_id' => $alt->id_mhs,
                'nama' => $alt->nama,
                'nim' => $alt->nim,
                'ncf' => round($ncf, 4),
                'nsf' => round($nsf, 4),
                'total' => round($total, 4),
            ];
        }

        usort($hasil, function($a, $b) {
            return $b['total'] <=> $a['total'];
        });

        // PASTIKAN INI
        return view('datamaster.rangking.index', compact('hasil'));
    }

    public function detail($id)
    {
        return redirect()->route('profile-matching.detail', $id);
    }
}

