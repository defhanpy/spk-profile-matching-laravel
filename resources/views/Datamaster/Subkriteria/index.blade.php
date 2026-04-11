@extends('layouts.app')
@section('title', 'Data Sub Kriteria')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Data Sub Kriteria</h1>
    <p class="mb-4">Data sub kriteria (simulasi tanpa database, disimpan di session).</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Sub Kriteria</h6>
            <a href="{{ route('subkriteria.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Sub Kriteria
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kriteria</th>
                            <th>Nama Sub Kriteria</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($subkriteria as $i => $row)
                        @php
                            $kid = $row['kriteria_id'];
                            $namaK = $kriteria[$kid]['nama_kriteria'] ?? 'Tidak diketahui';
                        @endphp
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $kid }}. {{ $namaK }}</td>
                            <td>{{ $row['nama_sub_kriteria'] }}</td>
                            <td>{{ $row['nilai'] }}</td>
                            <td class="d-flex" style="gap: 6px;">
                                <a href="{{ route('subkriteria.edit', $row['id_sub']) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('subkriteria.destroy', $row['id_sub']) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus sub kriteria ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
@endsection
