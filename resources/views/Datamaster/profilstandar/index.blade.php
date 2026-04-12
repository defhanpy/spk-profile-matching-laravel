@extends('layouts.app')
@section('title', 'Profil Standar')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Profil Standar</h1>
    <p class="mb-4">Berikut data profil standar yang dipilih.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Profil Standar</h6>
            <a href="{{ route('profil-standar.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Profil Standar
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Kriteria</th>
                            <th>Sub Kriteria yang Dipilih</th>
                            <th style="width:180px;">Nilai Profil Standar</th>
                            <th style="width:120px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($rows as $i => $r)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $r['nama_kriteria'] }}</td>
                            <td>{{ $r['nama_sub'] }}</td>
                            <td>{{ $r['nilai'] }}</td>
                            <td class="d-flex" style="gap:6px;">
                                <a href="{{ route('profil-standar.edit', $r['id']) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('profil-standar.destroy', $r['id']) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
@endsection
