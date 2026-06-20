<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AlternatifController extends Controller
{
    /**
     * Menampilkan seluruh data alternatif.
     */
    public function index(): View
    {
        $alternatif = Alternatif::orderBy('created_at', 'desc')->get();

        return view('datamaster.alternatif.index', compact('alternatif'));
    }

    /**
     * Menampilkan form tambah data.
     */
    public function create(): View
    {
        return view('datamaster.alternatif.create');
    }

    /**
     * Menyimpan data baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nim' => 'required|string|max:20|unique:alternatifs,nim',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',

            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:alternatifs,email',

            'alamat' => 'required|string',

            'prodi' => 'required|string|max:100',
            'fakultas' => 'required|string|max:100',

            'angkatan' => 'required|digits:4',
            'semester' => 'required|integer|min:1|max:14',

            'ipk' => 'required|numeric|min:0|max:4',

            'penghasilan_orang_tua' => 'required|numeric|min:0',

            'jumlah_tanggungan' => 'required|integer|min:0',

            'status' => 'required|string|max:50',
        ]);

        Alternatif::create($validated);

        return redirect()
            ->route('alternatif.index')
            ->with('success', 'Data alternatif berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data alternatif.
     */
    public function show(string $id): View
    {
        $alternatif = Alternatif::findOrFail($id);

        return view('datamaster.alternatif.show', compact('alternatif'));
    }

    /**
     * Menampilkan form edit data.
     */
    public function edit(string $id): View
    {
        $alternatif = Alternatif::findOrFail($id);

        return view('datamaster.alternatif.edit', compact('alternatif'));
    }

    /**
     * Mengupdate data alternatif.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $alternatif = Alternatif::findOrFail($id);

        $validated = $request->validate([
            'nim' => 'required|string|max:20|unique:alternatifs,nim,' . $id . ',id_mhs',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',

            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:alternatifs,email,' . $id . ',id_mhs',

            'alamat' => 'required|string',

            'prodi' => 'required|string|max:100',
            'fakultas' => 'required|string|max:100',

            'angkatan' => 'required|digits:4',
            'semester' => 'required|integer|min:1|max:14',

            'ipk' => 'required|numeric|min:0|max:4',

            'penghasilan_orang_tua' => 'required|numeric|min:0',

            'jumlah_tanggungan' => 'required|integer|min:0',

            'status' => 'required|string|max:50',
        ]);

        $alternatif->update($validated);

        return redirect()
            ->route('alternatif.index')
            ->with('success', 'Data alternatif berhasil diperbarui.');
    }

    /**
     * Menghapus data alternatif.
     */
    public function destroy(string $id): RedirectResponse
    {
        $alternatif = Alternatif::findOrFail($id);

        $alternatif->delete();

        return redirect()
            ->route('alternatif.index')
            ->with('success', 'Data alternatif berhasil dihapus.');
    }
}
