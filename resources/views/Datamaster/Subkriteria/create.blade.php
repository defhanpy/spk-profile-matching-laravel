@extends('layouts.app')
@section('title', 'Tambah Sub Kriteria')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-3 text-gray-800">Tambah Sub Kriteria</h1>
    <p class="mb-4">Form menambah sub kriteria (session).</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Sub Kriteria</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('subkriteria.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label>Kriteria</label>
                    <select name="kriteria_id" class="form-control">
                        <option value="">-- Pilih Kriteria --</option>
                        @foreach($kriteria as $k)
                            <option value="{{ $k['id_kriteria'] }}"
                                {{ old('kriteria_id') == $k['id_kriteria'] ? 'selected' : '' }}>
                                {{ $k['id_kriteria'] }}. {{ $k['nama_kriteria'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('kriteria_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Nama Sub Kriteria</label>
                    <input type="text" name="nama_sub_kriteria" value="{{ old('nama_sub_kriteria') }}"
                           class="form-control" placeholder="Contoh: >= 3 dan < 3.5">
                    @error('nama_sub_kriteria') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group mb-4">
                    <label>Nilai</label>
                    <select name="nilai" class="form-control">
                        <option value="">-- Pilih Nilai --</option>
                        @for($n=1; $n<=4; $n++)
                            <option value="{{ $n }}" {{ old('nilai') == $n ? 'selected' : '' }}>{{ $n }}</option>
                        @endfor
                    </select>
                    @error('nilai') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>

                    <a href="{{ route('subkriteria.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
