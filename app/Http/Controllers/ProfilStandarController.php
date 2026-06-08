<?php

namespace App\Http\Controllers;

use App\Models\ProfilStandar;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class ProfilStandarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profilStandars = ProfilStandar::with([
            'kriteria',
            'subKriteria'
        ])->get();

        return view('datamaster.profilstandar.index', compact('profilStandars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriterias = Kriteria::all();
        $subKriterias = SubKriteria::all();

        return view('datamaster.profilstandar.create', compact(
            'kriterias',
            'subKriterias'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required',
            'sub_kriteria_id' => 'required',
            'nilai' => 'required|numeric',
        ]);

        ProfilStandar::create([
            'kriteria_id' => $request->kriteria_id,
            'sub_kriteria_id' => $request->sub_kriteria_id,
            'nilai' => $request->nilai,
        ]);

        return redirect()
            ->route('profilstandar.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $profil = ProfilStandar::findOrFail($id);

        $kriterias = Kriteria::all();
        $subKriterias = SubKriteria::all();

        return view('datamaster.profilstandar.edit', compact(
            'profil',
            'kriterias',
            'subKriterias'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kriteria_id' => 'required',
            'sub_kriteria_id' => 'required',
            'nilai' => 'required|numeric',
        ]);

        $profilStandar = ProfilStandar::findOrFail($id);

        $profilStandar->update([
            'kriteria_id' => $request->kriteria_id,
            'sub_kriteria_id' => $request->sub_kriteria_id,
            'nilai' => $request->nilai,
        ]);

        return redirect()
            ->route('profilstandar.index')
            ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $profilStandar = ProfilStandar::findOrFail($id);

        $profilStandar->delete();

        return redirect()
            ->route('profilstandar.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
