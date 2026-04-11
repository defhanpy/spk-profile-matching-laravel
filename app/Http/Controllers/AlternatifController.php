<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    private function seedIfEmpty(Request $request): void
    {
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
    }

    public function index(Request $request)
    {
        $this->seedIfEmpty($request);

        $alternatif = collect($request->session()->get('alternatif', []))->values();

        return view('datamaster.alternatif.index', compact('alternatif'));
    }

    public function create()
    {
        return view('datamaster.alternatif.create');
    }

    public function store(Request $request)
    {
        $this->seedIfEmpty($request);

        $validated = $request->validate([
            'nim' => 'required|string|max:50',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'prodi' => 'required|string|max:100',
            'fakultas' => 'required|string|max:100',
            'angkatan' => 'required|integer|min:2000|max:2100',
            'semester' => 'required|integer|min:1|max:14',
            'ipk' => 'required|numeric|min:0|max:4',
            'penghasilan_orang_tua' => 'required|integer|min:0',
            'jumlah_tanggungan' => 'required|integer|min:0|max:20',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $lastId = (int) $request->session()->get('alternatif_last_id', 0);
        $newId  = $lastId + 1;

        $data = $request->session()->get('alternatif', []);
        $data[$newId] = array_merge($validated, ['id_mhs' => $newId]);

        $request->session()->put('alternatif', $data);
        $request->session()->put('alternatif_last_id', $newId);

        return redirect()->route('alternatif.index')->with('success', 'alternatif berhasil ditambahkan (session).');
    }

    public function edit(Request $request, $id)
    {
        $this->seedIfEmpty($request);

        $data = $request->session()->get('alternatif', []);
        if (!isset($data[$id])) abort(404);

        $mhs = $data[$id];
        return view('datamaster.alternatif.edit', compact('mhs'));
    }

    public function update(Request $request, $id)
    {
        $this->seedIfEmpty($request);

        $validated = $request->validate([
            'nim' => 'required|string|max:50',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'prodi' => 'required|string|max:100',
            'fakultas' => 'required|string|max:100',
            'angkatan' => 'required|integer|min:2000|max:2100',
            'semester' => 'required|integer|min:1|max:14',
            'ipk' => 'required|numeric|min:0|max:4',
            'penghasilan_orang_tua' => 'required|integer|min:0',
            'jumlah_tanggungan' => 'required|integer|min:0|max:20',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $data = $request->session()->get('alternatif', []);
        if (!isset($data[$id])) abort(404);

        $data[$id] = array_merge($data[$id], $validated);

        $request->session()->put('alternatif', $data);

        return redirect()->route('alternatif.index')->with('success', 'alternatif berhasil diupdate (session).');
    }

    public function destroy(Request $request, $id)
    {
        $this->seedIfEmpty($request);

        $data = $request->session()->get('alternatif', []);
        unset($data[$id]);

        $request->session()->put('alternatif', $data);

        return redirect()->route('alternatif.index')->with('success', 'alternatif berhasil dihapus (session).');
    }
}
