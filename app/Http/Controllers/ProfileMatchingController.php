<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\NilaiProfil;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\ProfilStandar;

class ProfileMatchingController extends Controller
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
        try {
            $standar = ProfilStandar::with(['kriteria', 'subKriteria'])
                ->get()
                ->keyBy('kriteria_id');

            $kriteriaList = Kriteria::all()->keyBy('id');

            $nilaiMahasiswa = NilaiProfil::with(['alternatif', 'kriteria', 'subKriteria'])
                ->get()
                ->groupBy('alternatif_id');

            if ($nilaiMahasiswa->isEmpty()) {
                return view('datamaster.profile_matching.index', [
                    'hasil' => [],
                    'error' => 'Belum ada data nilai alternatif'
                ]);
            }

            if ($standar->isEmpty()) {
                return view('datamaster.profile_matching.index', [
                    'hasil' => [],
                    'error' => 'Belum ada data standar profile matching'
                ]);
            }

            $hasil = [];

            foreach ($nilaiMahasiswa as $alternatifId => $nilaiList) {
                $rows = [];
                $coreValues = [];
                $secondaryValues = [];
                $namaAlternatif = '';

                foreach ($nilaiList as $nilai) {
                    $kriteriaId = $nilai->kriteria_id;
                    $nilaiMhs = $nilai->nilai;

                    $nilaiStd = isset($standar[$kriteriaId]) ? $standar[$kriteriaId]->nilai : 5;

                    $gap = $nilaiMhs - $nilaiStd;

                    $bobot = $this->bobotGap[$gap] ?? 0;

                    $jenisKriteria = isset($kriteriaList[$kriteriaId])
                        ? $kriteriaList[$kriteriaId]->jenis_kriteria
                        : 'secondary';

                    $isCore = ($jenisKriteria == 'core' || $jenisKriteria == 'Core');

                    $rows[] = [
                        'kriteria_id' => $kriteriaId,
                        'nama_kriteria' => $nilai->kriteria->nama ?? "Kriteria {$kriteriaId}",
                        'nama_sub_mhs' => $nilai->subKriteria->sub_kriteria ?? '-',
                        'nama_sub_std' => isset($standar[$kriteriaId]) && $standar[$kriteriaId]->subKriteria
                            ? $standar[$kriteriaId]->subKriteria->sub_kriteria
                            : '-',
                        'nilai_mhs' => $nilaiMhs,
                        'nilai_std' => $nilaiStd,
                        'gap' => $gap,
                        'bobot' => $bobot,
                        'jenis' => $isCore ? 'Core' : 'Secondary'
                    ];

                    if ($isCore) {
                        $coreValues[] = $bobot;
                    } else {
                        $secondaryValues[] = $bobot;
                    }

                    $namaAlternatif = $nilai->alternatif->nama ?? "Alternatif {$alternatifId}";
                }

                $ncf = !empty($coreValues) ? array_sum($coreValues) / count($coreValues) : 0;
                $nsf = !empty($secondaryValues) ? array_sum($secondaryValues) / count($secondaryValues) : 0;
                $total = (0.6 * $ncf) + (0.4 * $nsf);

                $hasil[] = [
                    'alternatif_id' => $alternatifId,
                    'nama' => $namaAlternatif,
                    'rows' => $rows,
                    'ncf' => $ncf,
                    'nsf' => $nsf,
                    'total' => $total
                ];
            }

            usort($hasil, function($a, $b) {
                return $b['total'] <=> $a['total'];
            });

            return view('datamaster.profile_matching.index', compact('hasil'));

        } catch (\Exception $e) {
            return view('datamaster.profile_matching.index', [
                'hasil' => [],
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function detail($id)
    {
        $data = NilaiProfil::with(['alternatif', 'kriteria', 'subKriteria'])
            ->where('alternatif_id', $id)
            ->get();

        if ($data->isEmpty()) {
            return redirect()->route('profile-matching.index')->with('error', 'Data tidak ditemukan');
        }

        return view('datamaster.profile_matching.detail', compact('data'));
    }
}
