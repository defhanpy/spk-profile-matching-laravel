@extends('layouts.app')
@section('title', 'Data Kriteria')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Data Kriteria</h1>
    <p class="mb-4">Berikut adalah data kriteria (simulasi tanpa database, disimpan di session).</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Kriteria</h6>
            <a href="{{ route('kriteria.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Kriteria
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Kriteria</th>
                            <th>Jenis Kriteria</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($kriteria as $i => $row)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $row['nama_kriteria'] }}</td>
                            <td>{{ $row['jenis_kriteria'] }}</td>
                            <td class="d-flex" style="gap: 6px;">
                                <a href="{{ route('kriteria.edit', $row['id_kriteria']) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('kriteria.destroy', $row['id_kriteria']) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kriteria ini?')">
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
