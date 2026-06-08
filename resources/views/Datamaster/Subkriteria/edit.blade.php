@extends('layouts.app')
@section('title', 'Edit Sub Kriteria')

@section('content')

<div class="container-fluid">

    <!-- Heading -->
    <h1 class="h3 mb-3 text-gray-800">Edit Sub Kriteria</h1>
    <p class="mb-4">Form untuk mengubah data sub kriteria SPK.</p>

    <!-- Card -->
    <div class="card shadow mb-4">

        <!-- Header -->
        <div class="card-header py-3 d-flex align-items-center">

            <h6 class="m-0 font-weight-bold text-primary mr-auto">
                Form Edit Sub Kriteria
            </h6>

            <a href="{{ route('subkriteria.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i>
                Kembali
            </a>

        </div>

        <!-- Body -->
        <div class="card-body">

            <form action="{{ route('subkriteria.update', $subkriteria->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Kriteria -->
                <div class="form-group mb-4">
                    <label>Kriteria</label>
                    <select name="kriteria_id" class="form-control" required>

                        <option value="">-- Pilih Kriteria --</option>

                        @foreach($kriterias as $k)
                            <option value="{{ $k->id }}"
                                {{ old('kriteria_id', $subkriteria->kriteria_id) == $k->id ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach

                    </select>

                    @error('kriteria_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Sub Kriteria -->
                <div class="form-group mb-4">
                    <label>Sub Kriteria</label>
                    <input type="text"
                           name="sub_kriteria"
                           class="form-control"
                           value="{{ old('sub_kriteria', $subkriteria->sub_kriteria) }}"
                           placeholder="Contoh: >= 3 dan < 3.5"
                           required>

                    @error('sub_kriteria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Nilai -->
                <div class="form-group mb-4">
                    <label>Nilai</label>
                    <input type="number"
                           name="nilai"
                           class="form-control"
                           value="{{ old('nilai', $subkriteria->nilai) }}"
                           placeholder="1 - 5"
                           required>

                    @error('nilai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Button -->
                <div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection
