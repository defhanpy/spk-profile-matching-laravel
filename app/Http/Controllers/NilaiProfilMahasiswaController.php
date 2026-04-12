<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NilaiProfilMahasiswaController extends Controller
{
    /**
     * Pastikan seed alternatif/kriteria/subkriteria ada.
     * NOTE:
     * - Kalau di project kamu sudah punya controller seed masing-masing,
     *   lebih bagus dipindahkan ke Service/Helper biar tidak duplikat.
     */
    private function seedIfEmpty(Request $request): void
    {
        // alternatif
        if (!$request->session()->has('alternatif')) {
            $request->session()->put('alternatif', [
                1 => [
                    'id_mhs' => 1,
                    'nim' => '2022010001',
                    'nama' => 'IQBAL',
                    'jenis_kelamin' => 'Laki-laki',
                    'tempat_lahir' => 'Bandung',
                    'tanggal_lahir' => '2003-08-14',
                    'alamat' => 'Jl. Merdeka No. 10, Bandung',
                    'no_hp' => '081234567801',
                    'email' => 'iqbal@kampus.ac.id',
                    'prodi' => 'Teknik Informatika',
                    'fakultas' => 'Fakultas Ilmu Komputer',
                    'angkatan' => 2022,
                    'semester' => 4,
                    'ipk' => 3.62,
                    'penghasilan_orang_tua' => 2500000,
                    'jumlah_tanggungan' => 3,
                    'status' => 'Aktif',
                ],
                2 => [
                    'id_mhs' => 2,
                    'nim' => '2022010002',
                    'nama' => 'IRMA',
                    'jenis_kelamin' => 'Perempuan',
                    'tempat_lahir' => 'Garut',
                    'tanggal_lahir' => '2004-02-03',
                    'alamat' => 'Kp. Sukamaju, Garut',
                    'no_hp' => '081234567802',
                    'email' => 'irma@kampus.ac.id',
                    'prodi' => 'Sistem Informasi',
                    'fakultas' => 'Fakultas Ilmu Komputer',
                    'angkatan' => 2022,
                    'semester' => 7,
                    'ipk' => 3.12,
                    'penghasilan_orang_tua' => 1200000,
                    'jumlah_tanggungan' => 2,
                    'status' => 'Aktif',
                ],
                3 => [
                    'id_mhs' => 3,
                    'nim' => '2022010003',
                    'nama' => 'GHANA',
                    'jenis_kelamin' => 'Perempuan',
                    'tempat_lahir' => 'Tasikmalaya',
                    'tanggal_lahir' => '2003-11-22',
                    'alamat' => 'Jl. Raya Tasik No. 5, Tasikmalaya',
                    'no_hp' => '081234567803',
                    'email' => 'ghana@kampus.ac.id',
                    'prodi' => 'Manajemen',
                    'fakultas' => 'Fakultas Ekonomi dan Bisnis',
                    'angkatan' => 2022,
                    'semester' => 3,
                    'ipk' => 2.78,
                    'penghasilan_orang_tua' => 5500000,
                    'jumlah_tanggungan' => 1,
                    'status' => 'Aktif',
                ],
                4 => [
                    'id_mhs' => 4,
                    'nim' => '2022010004',
                    'nama' => 'NURIL',
                    'jenis_kelamin' => 'Laki-laki',
                    'tempat_lahir' => 'Cimahi',
                    'tanggal_lahir' => '2004-06-30',
                    'alamat' => 'Jl. Pahlawan No. 7, Cimahi',
                    'no_hp' => '081234567804',
                    'email' => 'nuril@kampus.ac.id',
                    'prodi' => 'Teknik Industri',
                    'fakultas' => 'Fakultas Teknik',
                    'angkatan' => 2022,
                    'semester' => 2,
                    'ipk' => 3.45,
                    'penghasilan_orang_tua' => 3200000,
                    'jumlah_tanggungan' => 4,
                    'status' => 'Aktif',
                ],
            ]);
            $request->session()->put('alternatif_last_id', 4);
        }

        // kriteria
        if (!$request->session()->has('kriteria')) {
            $request->session()->put('kriteria', [
                1 => ['id_kriteria' => 1, 'nama_kriteria' => 'IPK',                  'jenis_kriteria' => 'Core Factor'],
                2 => ['id_kriteria' => 2, 'nama_kriteria' => 'Penghasilan Orang Tua','jenis_kriteria' => 'Core Factor'],
                3 => ['id_kriteria' => 3, 'nama_kriteria' => 'Jumlah Tanggungan',    'jenis_kriteria' => 'Secondary Factor'],
                4 => ['id_kriteria' => 4, 'nama_kriteria' => 'Semester',             'jenis_kriteria' => 'Secondary Factor'],
            ]);
            $request->session()->put('kriteria_last_id', 4);
        }

        // subkriteria
        if (!$request->session()->has('subkriteria')) {
            $request->session()->put('subkriteria', [
                1  => ['id_sub' => 1,  'kriteria_id' => 1, 'nama_sub_kriteria' => '< 2.5',                         'nilai' => 1],
                2  => ['id_sub' => 2,  'kriteria_id' => 1, 'nama_sub_kriteria' => '>= 2.5 dan < 3',                'nilai' => 2],
                3  => ['id_sub' => 3,  'kriteria_id' => 1, 'nama_sub_kriteria' => '>= 3 dan < 3.5',                'nilai' => 3],
                4  => ['id_sub' => 4,  'kriteria_id' => 1, 'nama_sub_kriteria' => '>= 3.5',                        'nilai' => 4],

                5  => ['id_sub' => 5,  'kriteria_id' => 2, 'nama_sub_kriteria' => '< 1,500,000',                   'nilai' => 4],
                6  => ['id_sub' => 6,  'kriteria_id' => 2, 'nama_sub_kriteria' => '>= 1,500,000 dan <= 3,000,000', 'nilai' => 3],
                7  => ['id_sub' => 7,  'kriteria_id' => 2, 'nama_sub_kriteria' => '> 3,000,000 dan < 5,000,000',   'nilai' => 2],
                8  => ['id_sub' => 8,  'kriteria_id' => 2, 'nama_sub_kriteria' => '>= 5,000,000',                  'nilai' => 1],

                9  => ['id_sub' => 9,  'kriteria_id' => 3, 'nama_sub_kriteria' => 'Jumlah <= 1',                   'nilai' => 1],
                10 => ['id_sub' => 10, 'kriteria_id' => 3, 'nama_sub_kriteria' => 'Jumlah 2',                      'nilai' => 2],
                11 => ['id_sub' => 11, 'kriteria_id' => 3, 'nama_sub_kriteria' => 'Jumlah 3',                      'nilai' => 3],
                12 => ['id_sub' => 12, 'kriteria_id' => 3, 'nama_sub_kriteria' => 'Jumlah > 3',                    'nilai' => 4],

                // NOTE: disesuaikan dengan seed kamu (ada sedikit beda teks di controller lain)
                13 => ['id_sub' => 13, 'kriteria_id' => 4, 'nama_sub_kriteria' => 'Semester <= 2 atau > 8',         'nilai' => 1],
                14 => ['id_sub' => 14, 'kriteria_id' => 4, 'nama_sub_kriteria' => 'Semester 7 dan 8',               'nilai' => 2],
                15 => ['id_sub' => 15, 'kriteria_id' => 4, 'nama_sub_kriteria' => 'Semester 3',                     'nilai' => 3],
                16 => ['id_sub' => 16, 'kriteria_id' => 4, 'nama_sub_kriteria' => 'Semester 4 - 6',                 'nilai' => 4],
            ]);
            $request->session()->put('subkriteria_last_id', 16);
        }
    }

    private function pickIpkSub(float $ipk, array $subs): ?array
    {
        // mapping sesuai seed:
        // 1: < 2.5
        // 2: >= 2.5 dan < 3
        // 3: >= 3 dan < 3.5
        // 4: >= 3.5
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

    private function pickPenghasilanSub(int $penghasilan, array $subs): ?array
    {
        // 5: < 1,500,000 => nilai 4
        // 6: 1,500,000 - 3,000,000 => nilai 3
        // 7: >3,000,000 - <5,000,000 => nilai 2
        // 8: >=5,000,000 => nilai 1
        foreach ($subs as $s) {
            if ((int)$s['kriteria_id'] !== 2) continue;
            $id = (int)$s['id_sub'];
            if ($id === 5 && $penghasilan < 1500000) return $s;
            if ($id === 6 && $penghasilan >= 1500000 && $penghasilan <= 3000000) return $s;
            if ($id === 7 && $penghasilan > 3000000 && $penghasilan < 5000000) return $s;
            if ($id === 8 && $penghasilan >= 5000000) return $s;
        }
        return null;
    }

    private function pickTanggunganSub(int $tanggungan, array $subs): ?array
    {
        // 9: <=1
        // 10: 2
        // 11: 3
        // 12: >3
        foreach ($subs as $s) {
            if ((int)$s['kriteria_id'] !== 3) continue;
            $id = (int)$s['id_sub'];
            if ($id === 9 && $tanggungan <= 1) return $s;
            if ($id === 10 && $tanggungan === 2) return $s;
            if ($id === 11 && $tanggungan === 3) return $s;
            if ($id === 12 && $tanggungan > 3) return $s;
        }
        return null;
    }

    private function pickSemesterSub(int $semester, array $subs): ?array
    {
        // 13: <=2 atau >8
        // 14: 7 atau 8
        // 15: 3
        // 16: 4-6
        foreach ($subs as $s) {
            if ((int)$s['kriteria_id'] !== 4) continue;
            $id = (int)$s['id_sub'];

            if ($id === 13 && ($semester <= 2 || $semester > 8)) return $s;
            if ($id === 14 && ($semester === 7 || $semester === 8)) return $s;
            if ($id === 15 && $semester === 3) return $s;
            if ($id === 16 && ($semester >= 4 && $semester <= 6)) return $s;
        }
        return null;
    }

    public function index(Request $request)
    {
        $this->seedIfEmpty($request);

        $alternatif = collect($request->session()->get('alternatif', []))->values()->all();
        $kriteria   = collect($request->session()->get('kriteria', []))->values()->all();
        $sub        = collect($request->session()->get('subkriteria', []))->values()->all();

        // Map kriteria_id => nama_kriteria (untuk view)
        $kriteriaMap = [];
        foreach ($kriteria as $k) {
            $kriteriaMap[(int)$k['id_kriteria']] = $k['nama_kriteria'];
        }

        // build rows: setiap mahasiswa punya 4 baris (kriteria 1..4)
        $rows = [];
        $no = 1;

        foreach ($alternatif as $mhs) {
            $mhsId = (int)$mhs['id_mhs'];

            $ipkSub = $this->pickIpkSub((float)$mhs['ipk'], $sub);
            $pengSub = $this->pickPenghasilanSub((int)$mhs['penghasilan_orang_tua'], $sub);
            $tangSub = $this->pickTanggunganSub((int)$mhs['jumlah_tanggungan'], $sub);
            $semSub  = $this->pickSemesterSub((int)$mhs['semester'], $sub);

            $pairs = [
                1 => $ipkSub,
                2 => $pengSub,
                3 => $tangSub,
                4 => $semSub,
            ];

            foreach ([1,2,3,4] as $kid) {
                $s = $pairs[$kid];

                $rows[] = [
                    'no' => $no,
                    'mhs_id' => $mhsId,
                    'nama_mhs' => $mhs['nama'],
                    'kriteria_id' => $kid,
                    'nama_kriteria' => $kriteriaMap[$kid] ?? ('Kriteria '.$kid),
                    'sub_id' => $s['id_sub'] ?? null,
                    'nama_sub' => $s['nama_sub_kriteria'] ?? '-',
                    'nilai_profil' => $s['nilai'] ?? null,
                ];
            }

            $no++;
        }

        return view('datamaster.nilaiprofil.index', compact('rows'));
    }
}