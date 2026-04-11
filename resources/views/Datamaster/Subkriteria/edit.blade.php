@extends('layouts.app')
@section('title', 'Edit Sub Kriteria')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-3 text-gray-800">Edit Sub Kriteria</h1>
    <p class="mb-4">Form mengubah sub kriteria (session).</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Sub Kriteria</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('subkriteria.update', $sub['id_sub']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label>Kriteria</label>
                    <select name="kriteria_id" class="form-control">
                        @foreach($kriteria as $k)
                            <option value="{{ $k['id_kriteria'] }}"
                                {{ old('kriteria_id', $sub['kriteria_id']) == $k['id_kriteria'] ? 'selected' : '' }}>
                                {{ $k['id_kriteria'] }}. {{ $k['nama_kriteria'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('kriteria_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Nama Sub Kriteria</label>
                    <input type="text" name="nama_sub_kriteria"
                           value="{{ old('nama_sub_kriteria', $sub['nama_sub_kriteria']) }}"
                           class="form-control">
                    @error('nama_sub_kriteria') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group mb-4">
                    <label>Nilai</label>
                    <select name="nilai" class="form-control">
                        @for($n=1; $n<=4; $n++)
                            <option value="{{ $n }}" {{ old('nilai', $sub['nilai']) == $n ? 'selected' : '' }}>{{ $n }}</option>
                        @endfor
                    </select>
                    @error('nilai') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
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
