<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    private function seedKriteriaIfEmpty(Request $request): void
    {
        // memastikan kriteria ada (nyambung ke subkriteria)
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
                7  => ['id_sub' => 7,  'kriteria_id' => 2, 'nama_sub_kriteria' => '> 3,000,000 dan < 5,000,000',   'nilai' => 2],
                8  => ['id_sub' => 8,  'kriteria_id' => 2, 'nama_sub_kriteria' => '>= 5,000,000',                   'nilai' => 1],

                9  => ['id_sub' => 9,  'kriteria_id' => 3, 'nama_sub_kriteria' => 'Jumlah <= 1',                   'nilai' => 1],
                10 => ['id_sub' => 10, 'kriteria_id' => 3, 'nama_sub_kriteria' => 'Jumlah 2',                      'nilai' => 2],
                11 => ['id_sub' => 11, 'kriteria_id' => 3, 'nama_sub_kriteria' => 'Jumlah 3',                      'nilai' => 3],
                12 => ['id_sub' => 12, 'kriteria_id' => 3, 'nama_sub_kriteria' => 'Jumlah > 3',                    'nilai' => 4],

                13 => ['id_sub' => 13, 'kriteria_id' => 4, 'nama_sub_kriteria' => 'Semester <= 2 atau > 8',        'nilai' => 1],
                14 => ['id_sub' => 14, 'kriteria_id' => 4, 'nama_sub_kriteria' => 'Semester 7 dan 8',              'nilai' => 2],
                15 => ['id_sub' => 15, 'kriteria_id' => 4, 'nama_sub_kriteria' => 'Semester 3',                    'nilai' => 3],
                16 => ['id_sub' => 16, 'kriteria_id' => 4, 'nama_sub_kriteria' => 'Semester 4 dan 6',              'nilai' => 4],
            ]);
            $request->session()->put('subkriteria_last_id', 16);
        }
    }

    public function index(Request $request)
    {
        $this->seedKriteriaIfEmpty($request);
        $this->seedSubKriteriaIfEmpty($request);

        $kriteria = $request->session()->get('kriteria', []);
        $subkriteria = collect($request->session()->get('subkriteria', []))->values();

        return view('datamaster.subkriteria.index', compact('subkriteria', 'kriteria'));
    }

    public function create(Request $request)
    {
        $this->seedKriteriaIfEmpty($request);

        $kriteria = collect($request->session()->get('kriteria', []))->values();

        return view('datamaster.subkriteria.create', compact('kriteria'));
    }

    public function store(Request $request)
    {
        $this->seedKriteriaIfEmpty($request);
        $this->seedSubKriteriaIfEmpty($request);

        $validated = $request->validate([
            'kriteria_id'       => 'required|integer',
            'nama_sub_kriteria' => 'required|string|max:255',
            'nilai'             => 'required|integer|min:1|max:4',
        ]);

        $kriteria = $request->session()->get('kriteria', []);
        if (!isset($kriteria[(int)$validated['kriteria_id']])) {
            return back()->withErrors(['kriteria_id' => 'Kriteria tidak valid'])->withInput();
        }

        $lastId = (int) $request->session()->get('subkriteria_last_id', 0);
        $newId  = $lastId + 1;

        $data = $request->session()->get('subkriteria', []);
        $data[$newId] = [
            'id_sub'           => $newId,
            'kriteria_id'      => (int)$validated['kriteria_id'],
            'nama_sub_kriteria'=> $validated['nama_sub_kriteria'],
            'nilai'            => (int)$validated['nilai'],
        ];

        $request->session()->put('subkriteria', $data);
        $request->session()->put('subkriteria_last_id', $newId);

        return redirect()->route('subkriteria.index')->with('success', 'Sub kriteria berhasil ditambahkan (session).');
    }

    public function edit(Request $request, $id)
    {
        $this->seedKriteriaIfEmpty($request);
        $this->seedSubKriteriaIfEmpty($request);

        $data = $request->session()->get('subkriteria', []);
        if (!isset($data[$id])) abort(404);

        $sub = $data[$id];
        $kriteria = collect($request->session()->get('kriteria', []))->values();

        return view('datamaster.subkriteria.edit', compact('sub', 'kriteria'));
    }

    public function update(Request $request, $id)
    {
        $this->seedKriteriaIfEmpty($request);
        $this->seedSubKriteriaIfEmpty($request);

        $validated = $request->validate([
            'kriteria_id'       => 'required|integer',
            'nama_sub_kriteria' => 'required|string|max:255',
            'nilai'             => 'required|integer|min:1|max:4',
        ]);

        $kriteria = $request->session()->get('kriteria', []);
        if (!isset($kriteria[(int)$validated['kriteria_id']])) {
            return back()->withErrors(['kriteria_id' => 'Kriteria tidak valid'])->withInput();
        }

        $data = $request->session()->get('subkriteria', []);
        if (!isset($data[$id])) abort(404);

        $data[$id]['kriteria_id'] = (int)$validated['kriteria_id'];
        $data[$id]['nama_sub_kriteria'] = $validated['nama_sub_kriteria'];
        $data[$id]['nilai'] = (int)$validated['nilai'];

        $request->session()->put('subkriteria', $data);

        return redirect()->route('subkriteria.index')->with('success', 'Sub kriteria berhasil diupdate (session).');
    }

    public function destroy(Request $request, $id)
    {
        $this->seedSubKriteriaIfEmpty($request);

        $data = $request->session()->get('subkriteria', []);
        unset($data[$id]);

        $request->session()->put('subkriteria', $data);

        return redirect()->route('subkriteria.index')->with('success', 'Sub kriteria berhasil dihapus (session).');
    }
}
