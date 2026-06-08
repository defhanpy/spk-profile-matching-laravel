@extends('layouts.app')

@section('title', 'Profil Standar')

@section('content')

    <div class="container-fluid">

        <!-- Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <div>

                <h1 class="h3 mb-1 text-gray-800">
                    Profil Standar
                </h1>

                <p class="mb-0 text-muted">
                    Data profil standar berdasarkan kriteria dan sub kriteria yang dipilih.
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
                    Tabel Profil Standar
                </h6>

                <a href="{{ route('profilstandar.create') }}" class="btn btn-primary btn-sm">

                    <i class="fas fa-plus"></i>
                    Tambah Profil Standar

                </a>

            </div>

            <!-- Body -->
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                        <thead class="thead-light">

                            <tr>

                                <th width="60" class="text-center">
                                    No
                                </th>

                                <th>
                                    Kriteria
                                </th>

                                <th>
                                    Sub Kriteria yang Dipilih
                                </th>

                                <th width="180" class="text-center">
                                    Nilai
                                </th>

                                <th width="120" class="text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($profilStandars as $index => $item)
                                <tr>
                                    <td class="text-center">
                                        {{ $index + 1 }}
                                    </td>
                                    <td>

                                        {{ $item->kriteria->nama ?? '-' }}

                                    </td>
                                    <td>

                                        {{ $item->subKriteria->sub_kriteria ?? '-' }}

                                    </td>
                                    <td class="text-center">

                                        <span class="badge badge-primary px-3 py-2">

                                            {{ $item->nilai }}

                                        </span>

                                    </td>
                                    <td class="text-center">

                                        <div class="d-flex justify-content-center" style="gap:6px;">
                                            <a href="{{ route('profilstandar.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm">

                                                <i class="fas fa-edit"></i>

                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#hapusProfilStandarModal{{ $item->id }}">

                                                <i class="fas fa-trash"></i>

                                            </button>
                                            <div class="modal fade" id="hapusProfilStandarModal{{ $item->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="hapusProfilStandarLabel{{ $item->id }}"
                                                aria-hidden="true">

                                                <div class="modal-dialog modal-dialog-centered" role="document">

                                                    <div class="modal-content">

                                                        <div class="modal-header bg-danger text-white">

                                                            <h5 class="modal-title"
                                                                id="hapusProfilStandarLabel{{ $item->id }}">
                                                                Konfirmasi Hapus Profil Standar
                                                            </h5>

                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>

                                                        </div>
                                                        <div class="modal-body text-center">

                                                            <i
                                                                class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>

                                                            <h5>Yakin ingin menghapus data ini?</h5>

                                                            <p class="text-muted mb-0">
                                                                Data profil standar ini akan dihapus secara permanen.
                                                            </p>

                                                        </div>
                                                        <div class="modal-footer">

                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">
                                                                Batal
                                                            </button>

                                                            <form action="{{ route('profilstandar.destroy', $item->id) }}"
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

                                        Belum ada data profil standar.

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
