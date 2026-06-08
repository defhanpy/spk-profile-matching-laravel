<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('datamaster.kriteria.index', compact('kriterias'));
    }

    public function create()
    {
        return view('datamaster.kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required|in:Core,Secondary',
        ]);

        Kriteria::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('datamaster.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required|in:Core,Secondary',
        ]);

        $kriteria = Kriteria::findOrFail($id);

        $kriteria->update([
            'nama' => $request->nama_kriteria,
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('kriteria.index')
            ->with('success', 'Data berhasil diupdate');
    }

public function destroy($id)
{
    Kriteria::where('id', $id)->delete();

    return back()->with('success', 'Kriteria berhasil dihapus');
}
}