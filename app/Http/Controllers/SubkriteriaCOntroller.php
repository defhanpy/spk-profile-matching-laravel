<?php

namespace App\Http\Controllers;

use App\Models\SubKriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $subKriterias = SubKriteria::with('kriteria')->get();

        return view('datamaster.subkriteria.index', compact('subKriterias'));
    }

    public function create()
    {
        $kriterias = Kriteria::all();
        return view('datamaster.subkriteria.create', compact('kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required',
            'sub_kriteria' => 'required',
            'nilai' => 'required|numeric',
        ]);

        SubKriteria::create([
            'kriteria_id' => $request->kriteria_id,
            'sub_kriteria' => $request->sub_kriteria,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('subkriteria.index')
            ->with('success', 'Sub Kriteria berhasil ditambahkan');
    }

    public function edit($id)
{
    $subkriteria = SubKriteria::findOrFail($id);
    $kriterias = Kriteria::all();

    return view('datamaster.subkriteria.edit', compact('subkriteria', 'kriterias'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'kriteria_id' => 'required',
            'sub_kriteria' => 'required',
            'nilai' => 'required|numeric',

        ]);

        $sub = SubKriteria::findOrFail($id);

        $sub->update([
            'kriteria_id' => $request->kriteria_id,
            'sub_kriteria' => $request->sub_kriteria,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('subkriteria.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $sub = SubKriteria::findOrFail($id);
        $sub->delete();

        return redirect()->route('subkriteria.index')
            ->with('success', 'Sub Kriteria berhasil dihapus');
    }
}
