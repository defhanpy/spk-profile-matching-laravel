<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiProfil;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::all();
        $coreKriterias = Kriteria::where('jenis_kriteria', 'Core')->get();
        $secondaryKriterias = Kriteria::where('jenis_kriteria', 'Secondary')->get();

        $bobotCore = 60;
        $bobotSecondary = 40;

        $hasil = [];

        foreach ($alternatif as $alt) {
            $nilaiProfils = NilaiProfil::where('alternatif_id', $alt->id_mhs)->get();

            $totalCore = 0;
            $jumlahCore = 0;
            foreach ($coreKriterias as $core) {
                $nilai = $nilaiProfils->where('kriteria_id', $core->id)->first();
                if ($nilai) {
                    $totalCore += $nilai->nilai;
                    $jumlahCore++;
                }
            }
            $ncf = $jumlahCore > 0 ? $totalCore / $jumlahCore : 0;

            $totalSecondary = 0;
            $jumlahSecondary = 0;
            foreach ($secondaryKriterias as $secondary) {
                $nilai = $nilaiProfils->where('kriteria_id', $secondary->id)->first();
                if ($nilai) {
                    $totalSecondary += $nilai->nilai;
                    $jumlahSecondary++;
                }
            }
            $nsf = $jumlahSecondary > 0 ? $totalSecondary / $jumlahSecondary : 0;

            $total = ($ncf * $bobotCore / 100) + ($nsf * $bobotSecondary / 100);

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
        $data = NilaiProfil::with(['alternatif', 'kriteria', 'subKriteria'])
            ->where('alternatif_id', $id)
            ->get();

        if ($data->isEmpty()) {
            return redirect()->route('rangking.index')->with('error', 'Data tidak ditemukan');
        }

        // PASTIKAN INI
        return view('datamaster.rangking.detail', compact('data'));
    }
}
