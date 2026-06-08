@extends('layouts.app')
@section('title', 'Edit Profil Standar')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-3 text-gray-800">Edit Profil Standar</h1>
        <p class="mb-4">Form untuk mengubah data profil standar SPK.</p>

        <div class="card shadow mb-4">

            <div class="card-header py-3 d-flex align-items-center">

                <h6 class="m-0 font-weight-bold text-primary mr-auto">
                    Form Edit Profil Standar
                </h6>

                <a href="{{ route('profilstandar.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i>
                    Kembali
                </a>

            </div>

            <div class="card-body">

                <form action="{{ route('profilstandar.update', $profil->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Kriteria --}}
                    <div class="form-group mb-4">
                        <label>Kriteria</label>

                        <select name="kriteria_id"
                                id="kriteria_id"
                                class="form-control @error('kriteria_id') is-invalid @enderror">

                            <option value="">-- Pilih Kriteria --</option>

                            @foreach ($kriterias as $kriteria)
                                <option value="{{ $kriteria->id }}"
                                    {{ old('kriteria_id', $profil->kriteria_id) == $kriteria->id ? 'selected' : '' }}>
                                    {{ $kriteria->nama }}
                                </option>
                            @endforeach

                        </select>

                        @error('kriteria_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Sub Kriteria --}}
                    <div class="form-group mb-4">
                        <label>Sub Kriteria</label>

                        <select name="sub_kriteria_id"
                                id="sub_kriteria_id"
                                class="form-control @error('sub_kriteria_id') is-invalid @enderror">

                            <option value="">-- Pilih Sub Kriteria --</option>

                        </select>

                        @error('sub_kriteria_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Nilai --}}
                    <div class="form-group mb-4">
                        <label>Nilai</label>

                        <input type="text"
                               name="nilai"
                               id="nilai"
                               class="form-control @error('nilai') is-invalid @enderror"
                               value="{{ old('nilai', $profil->nilai) }}"
                               readonly>

                        @error('nilai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Button --}}
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Update
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

        const oldSubId = "{{ old('sub_kriteria_id', $profil->sub_kriteria_id) }}";

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

                if (selectedSubId == item.id) {
                    option.selected = true;
                    nilaiInput.value = item.nilai;
                }

                subSelect.appendChild(option);
            });
        }

        kriteriaSelect.addEventListener('change', function () {
            renderSubKriteria(this.value);
        });

        subSelect.addEventListener('change', function () {
            let selected = this.options[this.selectedIndex];
            nilaiInput.value = selected.getAttribute('data-nilai') || '';
        });

        document.addEventListener('DOMContentLoaded', function () {
            renderSubKriteria(kriteriaSelect.value, oldSubId);
        });
    </script>

@endsection
