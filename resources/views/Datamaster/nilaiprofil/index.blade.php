@extends('layouts.app')
@section('title', 'Nilai Profil')

@section('content')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 mb-1 text-gray-800">Nilai Profil</h1>
                <p class="mb-0 text-muted">
                    Hasil pemetaan nilai profil dari alternatif berdasarkan kriteria & sub kriteria.
                </p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Nilai Profil</h6>
                <div>
                    <form action="{{ route('nilaiprofil.hitung') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-sync-alt"></i> Hitung Profil
                        </button>
                    </form>
                    <!-- Tombol Hapus Semua -->
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusSemua">
                        <i class="fas fa-trash-alt"></i> Hapus Semua
                    </button>

                    <!-- Modal Popup Hapus -->
                    <div class="modal fade" id="modalHapusSemua" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">
                                        <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus
                                    </h5>
                                    <button type="button" class="close text-white" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                                    <h5>Yakin ingin menghapus semua data?</h5>
                                    <p class="text-muted mb-0">Semua data nilai profil akan dihapus permanen dan tidak bisa
                                        dikembalikan!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Batal
                                    </button>
                                    <form action="{{ route('nilaiprofil.clear') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Ya, Hapus Semua
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Mahasiswa</th>
                                <th>Kriteria</th>
                                <th>Sub Kriteria</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $item->alternatif->nama ?? '-' }}</strong><br>
                                        <small>{{ $item->alternatif->nim ?? '-' }}</small>
                                    </td>
                                    <td>{{ $item->kriteria->nama ?? '-' }}</td>

                                    <td>{{ $item->subKriteria->sub_kriteria ?? '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-primary">{{ $item->nilai }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Belum ada data. Klik tombol "Hitung Profil"
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
