@extends('layouts.app')
@section('title', 'Tambah Kriteria')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-3 text-gray-800">Tambah Kriteria</h1>
    <p class="mb-4">Form untuk menambah kriteria (simulasi tanpa database, disimpan di session).</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Kriteria</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('kriteria.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label>Nama Kriteria</label>
                    <input type="text" name="nama_kriteria" value="{{ old('nama_kriteria') }}"
                           class="form-control" placeholder="Masukkan nama kriteria">
                    @error('nama_kriteria') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group mb-4">
                    <label>Jenis Kriteria</label>
                    <select name="jenis_kriteria" class="form-control">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Core Factor" {{ old('jenis_kriteria') == 'Core Factor' ? 'selected' : '' }}>
                            Core Factor
                        </option>
                        <option value="Secondary Factor" {{ old('jenis_kriteria') == 'Secondary Factor' ? 'selected' : '' }}>
                            Secondary Factor
                        </option>
                    </select>
                    @error('jenis_kriteria') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>

                    <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
