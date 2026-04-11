@extends('layouts.app')
@section('title', 'Edit Kriteria')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-3 text-gray-800">Edit Kriteria</h1>
    <p class="mb-4">Form untuk mengubah kriteria (simulasi tanpa database, disimpan di session).</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Kriteria</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('kriteria.update', $kriteria['id_kriteria']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label>Nama Kriteria</label>
                    <input type="text" name="nama_kriteria"
                           value="{{ old('nama_kriteria', $kriteria['nama_kriteria']) }}"
                           class="form-control">
                    @error('nama_kriteria') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group mb-4">
                    <label>Jenis Kriteria</label>
                    <select name="jenis_kriteria" class="form-control">
                        <option value="Core Factor" {{ old('jenis_kriteria', $kriteria['jenis_kriteria']) == 'Core Factor' ? 'selected' : '' }}>
                            Core Factor
                        </option>
                        <option value="Secondary Factor" {{ old('jenis_kriteria', $kriteria['jenis_kriteria']) == 'Secondary Factor' ? 'selected' : '' }}>
                            Secondary Factor
                        </option>
                    </select>
                    @error('jenis_kriteria') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
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
