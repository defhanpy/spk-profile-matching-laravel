<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiProfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class NilaiProfilController extends Controller
{
    public function index()
    {
        $data = NilaiProfil::with(['alternatif', 'kriteria', 'subKriteria'])->get();
        return view('datamaster.nilaiprofil.index', compact('data'));
    }

    public function hitung(Request $request)
    {
        // Hapus data lama
        NilaiProfil::truncate();

        // Ambil semua data
        $alternatif = Alternatif::all();
        $kriterias = Kriteria::with('subKriteria')->get();

        // Ambil semua kolom dari tabel alternatif
        $columns = Schema::getColumnListing('alternatifs');

        foreach ($alternatif as $alt) {
            foreach ($kriterias as $kriteria) {

                // Ambil nilai dari alternatif berdasarkan nama kriteria
                $nilaiAsli = $this->getNilaiByKriteria($alt, $kriteria->nama, $columns);

                if ($nilaiAsli === null) continue;

                // Cari sub kriteria yang cocok
                $subKriteria = $this->findSubKriteriaMatch($kriteria->subKriteria, $nilaiAsli);

                if ($subKriteria) {
                    NilaiProfil::create([
                        'alternatif_id' => $alt->id_mhs,
                        'kriteria_id' => $kriteria->id,
                        'sub_kriteria_id' => $subKriteria->id,
                        'nilai' => $subKriteria->nilai,
                    ]);
                }
            }
        }

        return redirect()->route('nilaiprofil.index')->with('success', 'Nilai profil berhasil dihitung');
    }

    /**
     * Ambil nilai dari alternatif - 100% DINAMIS
     */
    private function getNilaiByKriteria($alternatif, $namaKriteria, $columns)
    {
        // Normalisasi nama kriteria
        $nama = strtolower(trim($namaKriteria));
        $namaUnderscore = str_replace(' ', '_', $nama);
        $namaTanpaSpasi = str_replace(' ', '', $nama);

        // Cari field yang cocok
        foreach ($columns as $column) {
            $col = strtolower($column);

            // Skip kolom yang bukan data
            if (in_array($col, ['id_mhs', 'created_at', 'updated_at', 'deleted_at', 'remember_token', 'email_verified_at'])) {
                continue;
            }

            // Cocokkan exact match
            if ($col == $nama || $col == $namaUnderscore || $col == $namaTanpaSpasi) {
                return $alternatif->$column;
            }

            // Cocokkan mengandung kata
            if (strpos($col, $nama) !== false || strpos($nama, $col) !== false) {
                return $alternatif->$column;
            }
        }

        return null;
    }

    /**
     * Cari sub kriteria yang cocok - 100% DINAMIS
     */
    private function findSubKriteriaMatch($subKriterias, $nilai)
    {
        foreach ($subKriterias as $sub) {
            $text = $sub->sub_kriteria;

            // Untuk data angka
            if (is_numeric($nilai)) {
                // Ambil semua angka dari teks sub kriteria
                preg_match_all('/\d+(?:\.\d+)?/', $text, $matches);
                $numbers = $matches[0];

                // Format: ">= X" atau "<= X" atau "> X" atau "< X"
                if (count($numbers) == 1) {
                    $angka = (float)$numbers[0];
                    if (strpos($text, '>=') !== false && $nilai >= $angka) return $sub;
                    if (strpos($text, '<=') !== false && $nilai <= $angka) return $sub;
                    if (strpos($text, '>') !== false && $nilai > $angka) return $sub;
                    if (strpos($text, '<') !== false && $nilai < $angka) return $sub;
                    if ($nilai == $angka) return $sub;
                }

                // Format: "X - Y" atau "X sampai Y" atau ">= X dan < Y"
                if (count($numbers) == 2) {
                    $min = (float)$numbers[0];
                    $max = (float)$numbers[1];
                    if ($nilai >= $min && $nilai <= $max) return $sub;
                    if ($nilai >= $min && $nilai < $max) return $sub;
                }
            }
            // Untuk data string (teks)
            else {
                $nilaiStr = strtolower(trim($nilai));
                $textStr = strtolower(trim($text));

                if ($textStr == $nilaiStr) return $sub;
                if (strpos($textStr, $nilaiStr) !== false) return $sub;
                if (strpos($nilaiStr, $textStr) !== false) return $sub;
            }
        }

        return null;
    }


    /**
     * Hapus semua data
     */
    public function clear()
    {
        NilaiProfil::truncate();
        return redirect()->back()->with('success', 'Semua data nilai profil berhasil dihapus');
    }

    /**
     * Hapus per ID
     */
    public function destroy($id)
    {
        $nilai = NilaiProfil::findOrFail($id);
        $nilai->delete();
        return redirect()->back()->with('success', 'Data nilai profil berhasil dihapus');
    }
}
