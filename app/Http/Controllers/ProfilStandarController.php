<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilStandarController extends Controller
{
    private function seedKriteriaIfEmpty(Request $request): void
    {
        if (!$request->session()->has('kriteria')) {
            $request->session()->put('kriteria', [
                1 => ['id_kriteria' => 1, 'nama_kriteria' => 'IPK',                  'jenis_kriteria' => 'Core Factor'],
                2 => ['id_kriteria' => 2, 'nama_kriteria' => 'Penghasilan Orang Tua', 'jenis_kriteria' => 'Core Factor'],
                3 => ['id_kriteria' => 3, 'nama_kriteria' => 'Jumlah Tanggungan',    'jenis_kriteria' => 'Secondary Factor'],
                4 => ['id_kriteria' => 4, 'nama_kriteria' => 'Semester',             'jenis_kriteria' => 'Secondary Factor'],
            ]);
            $request->session()->put('kriteria_last_id', 4);
        }
    }

    private function seedSubKriteriaIfEmpty(Request $request): void
    {
        if (!$request->session()->has('subkriteria')) {
            $request->session()->put('subkriteria', [
                1  => ['id_sub' => 1,  'kriteria_id' => 1, 'nama_sub_kriteria' => '< 2.5',                         'nilai' => 1],
                2  => ['id_sub' => 2,  'kriteria_id' => 1, 'nama_sub_kriteria' => '>= 2.5 dan < 3',                'nilai' => 2],
                3  => ['id_sub' => 3,  'kriteria_id' => 1, 'nama_sub_kriteria' => '>= 3 dan < 3.5',                'nilai' => 3],
                4  => ['id_sub' => 4,  'kriteria_id' => 1, 'nama_sub_kriteria' => '>= 3.5',                        'nilai' => 4],

                5  => ['id_sub' => 5,  'kriteria_id' => 2, 'nama_sub_kriteria' => '< 1,500,000',                   'nilai' => 4],
                6  => ['id_sub' => 6,  'kriteria_id' => 2, 'nama_sub_kriteria' => '>= 1,500,000 dan <= 3,000,000', 'nilai' => 3],
                7  => ['id_sub' => 7,  'kriteria_id' => 2, 'nama_sub_kriteria' => '>= 3,000,000 dan < 5,000,000',  'nilai' => 2],
                8  => ['id_sub' => 8,  'kriteria_id' => 2, 'nama_sub_kriteria' => '>= 5,000,000',                  'nilai' => 1],

                9  => ['id_sub' => 9,  'kriteria_id' => 3, 'nama_sub_kriteria' => 'Jumlah <= 1',                   'nilai' => 1],
                10 => ['id_sub' => 10, 'kriteria_id' => 3, 'nama_sub_kriteria' => 'Jumlah 2',                      'nilai' => 2],
                11 => ['id_sub' => 11, 'kriteria_id' => 3, 'nama_sub_kriteria' => 'Jumlah 3',                      'nilai' => 3],
                12 => ['id_sub' => 12, 'kriteria_id' => 3, 'nama_sub_kriteria' => 'Jumlah > 3',                    'nilai' => 4],

                13 => ['id_sub' => 13, 'kriteria_id' => 4, 'nama_sub_kriteria' => 'Semester <= 2 atau > 8',        'nilai' => 1],
                14 => ['id_sub' => 14, 'kriteria_id' => 4, 'nama_sub_kriteria' => 'Semester 7 dan 8',              'nilai' => 2],
                15 => ['id_sub' => 15, 'kriteria_id' => 4, 'nama_sub_kriteria' => 'Semester 3',                    'nilai' => 3],
                16 => ['id_sub' => 16, 'kriteria_id' => 4, 'nama_sub_kriteria' => 'Semester 4 - 6',                'nilai' => 4],
            ]);
            $request->session()->put('subkriteria_last_id', 16);
        }
    }

    private function seedProfilStandarIfEmpty(Request $request): void
    {
        // contoh seed sesuai tabel kamu (boleh dihapus kalau tidak mau default)
        if (!$request->session()->has('profil_standar')) {
            $request->session()->put('profil_standar', [
                1 => ['id' => 1, 'kriteria_id' => 1, 'sub_id' => 3,  'nilai' => 3],
                2 => ['id' => 2, 'kriteria_id' => 2, 'sub_id' => 7,  'nilai' => 2],
                3 => ['id' => 3, 'kriteria_id' => 3, 'sub_id' => 12, 'nilai' => 4],
                4 => ['id' => 4, 'kriteria_id' => 4, 'sub_id' => 16, 'nilai' => 4],
            ]);
            $request->session()->put('profil_standar_last_id', 4);
        }
    }

    public function index(Request $request)
    {
        $this->seedKriteriaIfEmpty($request);
        $this->seedSubKriteriaIfEmpty($request);
        $this->seedProfilStandarIfEmpty($request);

        $kriteriaMap = $request->session()->get('kriteria', []);
        $subMap = $request->session()->get('subkriteria', []);

        $rows = collect($request->session()->get('profil_standar', []))
            ->values()
            ->map(function ($row) use ($kriteriaMap, $subMap) {
                $k = $kriteriaMap[$row['kriteria_id']] ?? null;
                $s = $subMap[$row['sub_id']] ?? null;

                return [
                    'id' => $row['id'],
                    'kriteria_id' => $row['kriteria_id'],
                    'sub_id' => $row['sub_id'],
                    'nilai' => $row['nilai'],
                    'nama_kriteria' => $k['nama_kriteria'] ?? '-',
                    'nama_sub' => $s['nama_sub_kriteria'] ?? '-',
                ];
            });

        return view('datamaster.profilstandar.index', compact('rows'));
    }

    public function create(Request $request)
    {
        $this->seedKriteriaIfEmpty($request);
        $this->seedSubKriteriaIfEmpty($request);

        $kriteria = collect($request->session()->get('kriteria', []))->values();
        // subkriteria akan di-load via JS endpoint; tapi untuk fallback bisa kirim semua
        $subkriteria = collect($request->session()->get('subkriteria', []))->values();

        return view('datamaster.profilstandar.create', compact('kriteria', 'subkriteria'));
    }

    public function store(Request $request)
    {
        $this->seedKriteriaIfEmpty($request);
        $this->seedSubKriteriaIfEmpty($request);
        $this->seedProfilStandarIfEmpty($request);

        $validated = $request->validate([
            'kriteria_id' => 'required|integer',
            'sub_id'      => 'required|integer',
        ]);

        $kriteriaMap = $request->session()->get('kriteria', []);
        if (!isset($kriteriaMap[(int)$validated['kriteria_id']])) {
            return back()->withErrors(['kriteria_id' => 'Kriteria tidak valid'])->withInput();
        }

        $subMap = $request->session()->get('subkriteria', []);
        if (!isset($subMap[(int)$validated['sub_id']])) {
            return back()->withErrors(['sub_id' => 'Sub kriteria tidak valid'])->withInput();
        }

        // pastikan subkriteria itu milik kriteria yang dipilih
        if ((int)$subMap[(int)$validated['sub_id']]['kriteria_id'] !== (int)$validated['kriteria_id']) {
            return back()->withErrors(['sub_id' => 'Sub kriteria tidak sesuai dengan kriteria'])->withInput();
        }

        $nilaiAuto = (int)$subMap[(int)$validated['sub_id']]['nilai'];

        $lastId = (int) $request->session()->get('profil_standar_last_id', 0);
        $newId = $lastId + 1;

        $data = $request->session()->get('profil_standar', []);
        $data[$newId] = [
            'id' => $newId,
            'kriteria_id' => (int)$validated['kriteria_id'],
            'sub_id' => (int)$validated['sub_id'],
            'nilai' => $nilaiAuto, // AUTO dari subkriteria.nilai
        ];

        $request->session()->put('profil_standar', $data);
        $request->session()->put('profil_standar_last_id', $newId);

        return redirect()->route('profil-standar.index')
            ->with('success', 'Profil standar berhasil ditambahkan.');
    }

    public function edit(Request $request, $id)
    {
        $this->seedKriteriaIfEmpty($request);
        $this->seedSubKriteriaIfEmpty($request);
        $this->seedProfilStandarIfEmpty($request);

        $data = $request->session()->get('profil_standar', []);
        if (!isset($data[$id])) abort(404);

        $profil = $data[$id];
        $kriteria = collect($request->session()->get('kriteria', []))->values();
        $subkriteria = collect($request->session()->get('subkriteria', []))->values();

        return view('datamaster.profilstandar.edit', compact('profil', 'kriteria', 'subkriteria'));
    }

    public function update(Request $request, $id)
    {
        $this->seedKriteriaIfEmpty($request);
        $this->seedSubKriteriaIfEmpty($request);
        $this->seedProfilStandarIfEmpty($request);

        $validated = $request->validate([
            'kriteria_id' => 'required|integer',
            'sub_id'      => 'required|integer',
        ]);

        $data = $request->session()->get('profil_standar', []);
        if (!isset($data[$id])) abort(404);

        $kriteriaMap = $request->session()->get('kriteria', []);
        if (!isset($kriteriaMap[(int)$validated['kriteria_id']])) {
            return back()->withErrors(['kriteria_id' => 'Kriteria tidak valid'])->withInput();
        }

        $subMap = $request->session()->get('subkriteria', []);
        if (!isset($subMap[(int)$validated['sub_id']])) {
            return back()->withErrors(['sub_id' => 'Sub kriteria tidak valid'])->withInput();
        }

        if ((int)$subMap[(int)$validated['sub_id']]['kriteria_id'] !== (int)$validated['kriteria_id']) {
            return back()->withErrors(['sub_id' => 'Sub kriteria tidak sesuai dengan kriteria'])->withInput();
        }

        $nilaiAuto = (int)$subMap[(int)$validated['sub_id']]['nilai'];

        $data[$id]['kriteria_id'] = (int)$validated['kriteria_id'];
        $data[$id]['sub_id'] = (int)$validated['sub_id'];
        $data[$id]['nilai'] = $nilaiAuto; // AUTO update juga

        $request->session()->put('profil_standar', $data);

        return redirect()->route('profil-standar.index')
            ->with('success', 'Profil standar berhasil diupdate.');
    }

    public function destroy(Request $request, $id)
    {
        $this->seedProfilStandarIfEmpty($request);

        $data = $request->session()->get('profil_standar', []);
        unset($data[$id]);

        $request->session()->put('profil_standar', $data);

        return redirect()->route('profil-standar.index')
            ->with('success', 'Profil standar berhasil dihapus.');
    }

    /**
     * Endpoint AJAX: ambil subkriteria berdasarkan kriteria_id
     * Return JSON: [{id_sub, nama_sub_kriteria, nilai}, ...]
     */
    public function subByKriteria(Request $request)
    {
        $this->seedSubKriteriaIfEmpty($request);

        $kriteriaId = (int) $request->query('kriteria_id', 0);

        $sub = collect($request->session()->get('subkriteria', []))
            ->values()
            ->filter(fn($s) => (int)$s['kriteria_id'] === $kriteriaId)
            ->values()
            ->map(fn($s) => [
                'id_sub' => $s['id_sub'],
                'nama_sub_kriteria' => $s['nama_sub_kriteria'],
                'nilai' => $s['nilai'],
            ]);

        return response()->json($sub);
    }
}
