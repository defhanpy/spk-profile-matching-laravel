@extends('layouts.app')

@section('title', 'Tambah Profil Standar')

@section('content')

<div class="container-fluid">

    <!-- Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <div>
            <h1 class="h3 mb-1 text-gray-800">
                Tambah Profil Standar
            </h1>
            <p class="mb-0 text-muted">
                Form tambah data profil standar.
            </p>
        </div>

        <a href="{{ route('profilstandar.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>

    </div>

    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ route('profilstandar.store') }}" method="POST">
                @csrf

                <!-- Kriteria -->
                <div class="form-group mb-4">
                    <label>Kriteria</label>

                    <select name="kriteria_id"
                            id="kriteria_id"
                            class="form-control @error('kriteria_id') is-invalid @enderror">

                        <option value="">-- Pilih Kriteria --</option>

                        @foreach ($kriterias as $kriteria)
                            <option value="{{ $kriteria->id }}"
                                {{ old('kriteria_id') == $kriteria->id ? 'selected' : '' }}>
                                {{ $kriteria->nama }}
                            </option>
                        @endforeach

                    </select>

                    @error('kriteria_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sub Kriteria -->
                <div class="form-group mb-4">
                    <label>Sub Kriteria</label>

                    <select name="sub_kriteria_id"
                            id="sub_kriteria_id"
                            class="form-control @error('sub_kriteria_id') is-invalid @enderror">

                        <option value="">-- Pilih Sub Kriteria --</option>

                    </select>

                    @error('sub_kriteria_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nilai -->
                <div class="form-group mb-4">
                    <label>Nilai</label>

                    <input type="text"
                           name="nilai"
                           id="nilai"
                           class="form-control @error('nilai') is-invalid @enderror"
                           value="{{ old('nilai') }}"
                           readonly>

                    @error('nilai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Button -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>

            </form>

        </div>
    </div>

</div>

<script>
    const subKriterias = @json($subKriterias);

    const kriteriaSelect = document.getElementById('kriteria_id');
    const subSelect = document.getElementById('sub_kriteria_id');
    const nilaiInput = document.getElementById('nilai');

    function renderSubKriteria(kriteriaId, selectedSubId = null) {

        subSelect.innerHTML = '<option value="">-- Pilih Sub Kriteria --</option>';
        nilaiInput.value = '';

        if (!kriteriaId) return;

        const filtered = subKriterias.filter(item => item.kriteria_id == kriteriaId);

        filtered.forEach(item => {
            let option = document.createElement('option');
            option.value = item.id;
            option.text = item.sub_kriteria;
            option.setAttribute('data-nilai', item.nilai);

            if (selectedSubId && selectedSubId == item.id) {
                option.selected = true;
                nilaiInput.value = item.nilai;
            }

            subSelect.appendChild(option);
        });
    }

    // change kriteria
    kriteriaSelect.addEventListener('change', function () {
        renderSubKriteria(this.value);
    });

    // change sub kriteria
    subSelect.addEventListener('change', function () {
        let selected = this.options[this.selectedIndex];
        nilaiInput.value = selected.getAttribute('data-nilai') || '';
    });

    // init (old value support)
    document.addEventListener('DOMContentLoaded', function () {
        let oldKriteria = kriteriaSelect.value;
        let oldSub = "{{ old('sub_kriteria_id') }}";

        if (oldKriteria) {
            renderSubKriteria(oldKriteria, oldSub);
        }
    });
</script>

@endsection
