@extends('layouts.app')
@section('title', 'Data Kriteria')

@section('content')
<div class="container-fluid">

    <!-- Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <div>
            <h1 class="h3 mb-1 text-gray-800">Data Kriteria</h1>
            <p class="mb-0 text-muted">Data kriteria metode Profile Matching.</p>
        </div>

    </div>

    <!-- Alert Success -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <!-- Card -->
    <div class="card shadow mb-4">

        <!-- Header -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Kriteria</h6>

            <a href="{{ route('kriteria.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Kriteria
            </a>
        </div>

        <!-- Body -->
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                    <thead class="thead-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Kriteria</th>
                            <th>Jenis Factor</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($kriterias as $i => $row)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>

                                <td>{{ $row->nama }}</td>

                                <td class="text-center">
                                    <span class="badge badge-{{ $row->jenis_kriteria == 'Core' ? 'primary' : 'success' }}">
                                        {{ $row->jenis_kriteria == 'Core' ? 'Core (60%)' : 'Secondary (40%)' }}
                                    </span>
                                </td>

                                <td class="text-center">

                                    <div class="d-flex justify-content-center" style="gap:6px;">

                                        <a href="{{ route('kriteria.edit', $row->id) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <button type="button"
                                                class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#hapusKriteriaModal{{ $row->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal Hapus -->
                                        <div class="modal fade"
                                             id="hapusKriteriaModal{{ $row->id }}"
                                             tabindex="-1"
                                             role="dialog"
                                             aria-hidden="true">

                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">

                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body text-center">
                                                        <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>

                                                        <h5>Yakin ingin menghapus data ini?</h5>

                                                        <p class="text-muted mb-0">
                                                            Kriteria <strong>{{ $row->nama }}</strong> akan dihapus permanen.
                                                        </p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                            Batal
                                                        </button>

                                                        <form action="{{ route('kriteria.destroy', $row->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-trash"></i> Ya, Hapus
                                                            </button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Data kriteria belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
@endsection
