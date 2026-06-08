@extends('layouts.app')
@section('title', 'Edit Kriteria')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-3 text-gray-800">Edit Kriteria</h1>
        <p class="mb-4">Form untuk mengubah data kriteria SPK.</p>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary mr-auto">
                    Form Edit Kriteria
                </h6>

                <a href="{{ route('kriteria.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i>
                    Kembali
                </a>

            </div>
            <div class="card-body">

                <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama Kriteria --}}
                    <div class="form-group mb-4">
                        <label>Nama Kriteria</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $kriteria->nama) }}"
                            required>

                        @error('nama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        {{-- Jenis Kriteria --}}
                        <div class="form-group mb-4">
                            <label>Jenis Kriteria</label>
                            <select name="jenis" class="form-control" required>
                                <option value="">-- Pilih Jenis --</option>

                                <option value="Core" {{ old('jenis', $kriteria->jenis_kriteria) == 'Core' ? 'selected' : '' }}>
                                    Core Factor (Faktor Utama)
                                </option>

                                <option value="Secondary" {{ old('jenis', $kriteria->jenis_kriteria) == 'Secondary' ? 'selected' : '' }}>
                                    Secondary Factor (Faktor Pendukung)
                                </option>
                            </select>

                            @error('jenis')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>



                        {{-- Button --}}
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                </form>
            </div>
        </div>

    </div>

    </div>

@endsection
