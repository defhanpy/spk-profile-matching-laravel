@extends('layouts.app')
@section('title', 'Detail Profile Matching')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">Detail Profile Matching</h1>
            <p class="mb-0 text-muted">
                Hasil perhitungan profile matching mahasiswa
            </p>
        </div>
        <a href="{{ route('profile-matching.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Card Informasi Mahasiswa -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-user-graduate"></i> Data Mahasiswa
            </h6>
        </div>
        <div class="card-body">
            @php
                $first = $data->first();
                $alt = $first->alternatif ?? null;
            @endphp
            <div class="row">
                <div class="col-md-3">
                    <strong>NIM</strong>
                    <p class="text-muted">{{ $alt->nim ?? '-' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Nama</strong>
                    <p class="text-muted">{{ $alt->nama ?? '-' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Prodi</strong>
                    <p class="text-muted">{{ $alt->prodi ?? '-' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Fakultas</strong>
                    <p class="text-muted">{{ $alt->fakultas ?? '-' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Semester</strong>
                    <p class="text-muted">{{ $alt->semester ?? '-' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Angkatan</strong>
                    <p class="text-muted">{{ $alt->angkatan ?? '-' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>IPK</strong>
                    <p class="text-muted">{{ $alt->ipk ?? '-' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Status</strong>
                    <p class="text-muted">{{ $alt->status ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Hasil Profile Matching -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-success text-white">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-chart-line"></i> Hasil Profile Matching
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kriteria</th>
                            <th>Jenis Kriteria</th>
                            <th>Sub Kriteria</th>
                            <th class="text-center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalNilai = 0; @endphp
                        @foreach($data as $item)
                        @php
                            $totalNilai += $item->nilai;
                            $jenis = $item->kriteria->jenis_kriteria ?? '-';
                            $badgeColor = $jenis == 'Core' ? 'danger' : ($jenis == 'Secondary' ? 'warning' : 'secondary');
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kriteria->nama ?? '-' }}</td>
                            <td>
                                <span class="badge badge-{{ $badgeColor }}">{{ $jenis }}</span>
                            </td>
                            <td>{{ $item->subKriteria->sub_kriteria ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge badge-primary px-3 py-2">{{ $item->nilai }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-light">
                            <th colspan="4" class="text-right">Rata-rata Nilai:</th>
                            <th class="text-center">
                                {{ number_format($totalNilai / count($data), 2) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
