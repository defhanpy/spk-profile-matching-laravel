<?php
// app/Http/Controllers/RankingProfileMatchingController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RankingProfileMatchingController extends Controller
{
    private function bobotGap(int $gap): float
    {
        return match ($gap) {
            0  => 5.0,
            1  => 4.5,
            -1 => 4.0,
            2  => 3.5,
            -2 => 3.0,
            3  => 2.5,
            -3 => 2.0,
            4  => 1.5,
            -4 => 1.0,
            default => 0.0,
        };
    }

    private function pickIpkSub(float $ipk, array $subs): ?array
    {
        foreach ($subs as $s) {
            if ((int)$s['kriteria_id'] !== 1) continue;
            $id = (int)$s['id_sub'];
            if ($id === 1 && $ipk < 2.5) return $s;
            if ($id === 2 && $ipk >= 2.5 && $ipk < 3.0) return $s;
            if ($id === 3 && $ipk >= 3.0 && $ipk < 3.5) return $s;
            if ($id === 4 && $ipk >= 3.5) return $s;
        }
        return null;
    }

    private function pickPenghasilanSub(int $p, array $subs): ?array
    {
        foreach ($subs as $s) {
            if ((int)$s['kriteria_id'] !== 2) continue;
            $id = (int)$s['id_sub'];
            if ($id === 5 && $p < 1500000) return $s;
            if ($id === 6 && $p >= 1500000 && $p <= 3000000) return $s;
            if ($id === 7 && $p > 3000000 && $p < 5000000) return $s;
            if ($id === 8 && $p >= 5000000) return $s;
        }
        return null;
    }

    private function pickTanggunganSub(int $t, array $subs): ?array
    {
        foreach ($subs as $s) {
            if ((int)$s['kriteria_id'] !== 3) continue;
            $id = (int)$s['id_sub'];
            if ($id === 9 && $t <= 1) return $s;
            if ($id === 10 && $t === 2) return $s;
            if ($id === 11 && $t === 3) return $s;
            if ($id === 12 && $t > 3) return $s;
        }
        return null;
    }

    private function pickSemesterSub(int $sem, array $subs): ?array
    {
        foreach ($subs as $s) {
            if ((int)$s['kriteria_id'] !== 4) continue;
            $id = (int)$s['id_sub'];

            if ($id === 13 && ($sem <= 2 || $sem > 8)) return $s;
            if ($id === 14 && ($sem === 7 || $sem === 8)) return $s;
            if ($id === 15 && $sem === 3) return $s;
            if ($id === 16 && ($sem >= 4 && $sem <= 6)) return $s;
        }
        return null;
    }

    private function buildNilaiProfilMahasiswa(array $mhs, array $subs): array
    {
        $pairs = [
            1 => $this->pickIpkSub((float)($mhs['ipk'] ?? 0), $subs),
            2 => $this->pickPenghasilanSub((int)($mhs['penghasilan_orang_tua'] ?? 0), $subs),
            3 => $this->pickTanggunganSub((int)($mhs['jumlah_tanggungan'] ?? 0), $subs),
            4 => $this->pickSemesterSub((int)($mhs['semester'] ?? 0), $subs),
        ];

        $out = [];
        foreach ([1,2,3,4] as $kid) {
            $s = $pairs[$kid];
            $out[$kid] = [
                'nilai_mhs' => isset($s['nilai']) ? (int)$s['nilai'] : null,
            ];
        }
        return $out;
    }

    public function index(Request $request)
    {
        $alternatif = collect((array)$request->session()->get('alternatif', []))->values()->all();
        $kriteria   = (array)$request->session()->get('kriteria', []);
        $subs       = collect((array)$request->session()->get('subkriteria', []))->values()->all();
        $profilStd  = collect((array)$request->session()->get('profil_standar', []))->values()->all();

        if (empty($alternatif) || empty($kriteria) || empty($subs) || empty($profilStd)) {
            return view('penilaian.profile_matching.ranking', [
                'ranking' => [],
                'error' => 'Session alternatif/kriteria/subkriteria/profil_standar belum ada. Buka dulu menu Data Master yang melakukan seed.',
            ]);
        }

        // standar: kriteria_id => nilai
        $stdMap = [];
        foreach ($profilStd as $row) {
            $stdMap[(int)$row['kriteria_id']] = (int)$row['nilai'];
        }

        // jenis kriteria: Core/Secondary
        $jenisMap = [];
        foreach ($kriteria as $kid => $k) {
            $jenisMap[(int)$kid] = $k['jenis_kriteria'] ?? 'Secondary Factor';
        }

        $ranking = [];

        foreach ($alternatif as $mhs) {
            $nilaiMhsMap = $this->buildNilaiProfilMahasiswa($mhs, $subs);

            $coreBobots = [];
            $secBobots  = [];

            foreach ($jenisMap as $kid => $jenis) {
                $nilaiMhs = $nilaiMhsMap[$kid]['nilai_mhs'] ?? null;
                $nilaiStd = $stdMap[$kid] ?? null;
                if ($nilaiMhs === null || $nilaiStd === null) continue;

                $gap = (int)$nilaiMhs - (int)$nilaiStd;
                $bobot = $this->bobotGap($gap);

                if ($jenis === 'Core Factor') $coreBobots[] = $bobot;
                else $secBobots[] = $bobot;
            }

            $ncf = count($coreBobots) ? array_sum($coreBobots) / count($coreBobots) : 0.0;
            $nsf = count($secBobots) ? array_sum($secBobots) / count($secBobots) : 0.0;
            $total = (0.6 * $ncf) + (0.4 * $nsf);

            $ranking[] = [
                'nama' => $mhs['nama'] ?? '-',
                'nim'  => $mhs['nim'] ?? '-',
                'ncf' => $ncf,
                'nsf' => $nsf,
                'total' => $total,
            ];
        }

        // Sort total desc
        usort($ranking, fn($a, $b) => $b['total'] <=> $a['total']);

        // Tambah peringkat
        foreach ($ranking as $i => $r) {
            $ranking[$i]['rank'] = $i + 1;
        }

        return view('datamaster.rangking.index', [
            'ranking' => $ranking,
            'error' => null,
        ]);
    }
}
