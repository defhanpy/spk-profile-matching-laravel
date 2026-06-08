@extends('layouts.app')

@section('title', 'Data Sub Kriteria')

@section('content')

<div class="container-fluid">

    <!-- Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <div>
            <h1 class="h3 mb-1 text-gray-800">
                Data Sub Kriteria
            </h1>

            <p class="mb-0 text-muted">
                Daftar sub kriteria metode Profile Matching.
            </p>
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

    <!-- Alert Error -->
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('error') }}

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>

        </div>
    @endif

    <!-- Card -->
    <div class="card shadow mb-4">

        <!-- Header -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">

            <h6 class="m-0 font-weight-bold text-primary">
                Tabel Sub Kriteria
            </h6>

            <a href="{{ route('subkriteria.create') }}" class="btn btn-primary btn-sm">

                <i class="fas fa-plus"></i>
                Tambah Sub Kriteria

            </a>

        </div>

        <!-- Body -->
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover"
                       id="dataTable"
                       width="100%"
                       cellspacing="0">

                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kriteria</th>
                            <th>Sub Kriteria</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($subKriterias as $index => $item)
                            <tr>

                                <td class="text-center">
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    {{ $item->kriteria->nama ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->sub_kriteria }}
                                </td>

                                <td class="text-center">
                                    <span class="badge badge-info">
                                        {{ $item->nilai }}
                                    </span>
                                </td>

                                <td class="text-center">

                                    <div class="d-flex justify-content-center" style="gap:6px;">

                                        <!-- Edit -->
                                        <a href="{{ route('subkriteria.edit', $item->id) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <button type="button"
                                                class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#hapusSubKriteriaModal{{ $item->id }}">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                        <!-- Modal Hapus -->
                                        <div class="modal fade"
                                             id="hapusSubKriteriaModal{{ $item->id }}"
                                             tabindex="-1"
                                             role="dialog"
                                             aria-hidden="true">

                                            <div class="modal-dialog modal-dialog-centered" role="document">

                                                <div class="modal-content">

                                                    <!-- HEADER -->
                                                    <div class="modal-header bg-danger text-white">

                                                        <h5 class="modal-title">
                                                            Konfirmasi Hapus Data
                                                        </h5>

                                                        <button type="button" class="close text-white"
                                                                data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>

                                                    </div>

                                                    <!-- BODY -->
                                                    <div class="modal-body text-center">

                                                        <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>

                                                        <h5>Yakin ingin menghapus data ini?</h5>

                                                        <p class="text-muted mb-0">
                                                            Sub kriteria <strong>{{ $item->sub_kriteria }}</strong> akan dihapus secara permanen.
                                                        </p>

                                                    </div>

                                                    <!-- FOOTER -->
                                                    <div class="modal-footer">

                                                        <button type="button"
                                                                class="btn btn-secondary"
                                                                data-dismiss="modal">
                                                            Batal
                                                        </button>

                                                        <form action="{{ route('subkriteria.destroy', $item->id) }}"
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
                                <td colspan="5" class="text-center text-muted">
                                    Data belum tersedia
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
