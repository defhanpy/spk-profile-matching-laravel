<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    private function seedIfEmpty(Request $request): void
    {
        if (!$request->session()->has('kriteria')) {
            $request->session()->put('kriteria', [
                1 => ['id_kriteria' => 1, 'nama_kriteria' => 'IPK',                 'jenis_kriteria' => 'Core Factor'],
                2 => ['id_kriteria' => 2, 'nama_kriteria' => 'Penghasilan Orang Tua','jenis_kriteria' => 'Core Factor'],
                3 => ['id_kriteria' => 3, 'nama_kriteria' => 'Jumlah Tanggungan',   'jenis_kriteria' => 'Secondary Factor'],
                4 => ['id_kriteria' => 4, 'nama_kriteria' => 'Semester',            'jenis_kriteria' => 'Secondary Factor'],
            ]);

            $request->session()->put('kriteria_last_id', 4);
        }
    }

    public function index(Request $request)
    {
        $this->seedIfEmpty($request);

        $kriteria = collect($request->session()->get('kriteria', []))->values();

        return view('datamaster.kriteria.index', compact('kriteria'));
    }

    public function create()
    {
        return view('datamaster.kriteria.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kriteria'  => 'required|string|max:255',
            'jenis_kriteria' => 'required|in:Core Factor,Secondary Factor',
        ]);

        $this->seedIfEmpty($request);

        $lastId = (int) $request->session()->get('kriteria_last_id', 0);
        $newId  = $lastId + 1;

        $data = $request->session()->get('kriteria', []);
        $data[$newId] = [
            'id_kriteria'    => $newId,
            'nama_kriteria'  => $validated['nama_kriteria'],
            'jenis_kriteria' => $validated['jenis_kriteria'],
        ];

        $request->session()->put('kriteria', $data);
        $request->session()->put('kriteria_last_id', $newId);

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil ditambahkan (simulasi session).');
    }

    public function edit(Request $request, $id)
    {
        $this->seedIfEmpty($request);

        $data = $request->session()->get('kriteria', []);
        if (!isset($data[$id])) abort(404);

        $kriteria = $data[$id];
        return view('datamaster.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kriteria'  => 'required|string|max:255',
            'jenis_kriteria' => 'required|in:Core Factor,Secondary Factor',
        ]);

        $this->seedIfEmpty($request);

        $data = $request->session()->get('kriteria', []);
        if (!isset($data[$id])) abort(404);

        $data[$id]['nama_kriteria']  = $validated['nama_kriteria'];
        $data[$id]['jenis_kriteria'] = $validated['jenis_kriteria'];

        $request->session()->put('kriteria', $data);

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil diupdate (simulasi session).');
    }

    public function destroy(Request $request, $id)
    {
        $this->seedIfEmpty($request);

        $data = $request->session()->get('kriteria', []);
        unset($data[$id]);

        $request->session()->put('kriteria', $data);

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil dihapus (simulasi session).');
    }
}