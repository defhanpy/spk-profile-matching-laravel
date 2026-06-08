

@extends('layouts.app')

@section('title', 'Perhitungan Profile Matching')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perhitungan Metode Profile Matching</h1>
        <a href="{{ route('profile-matching.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-sync-alt fa-sm text-white-50"></i> Refresh
        </a>
    </div>

    <p class="mb-4">Berikut adalah hasil perhitungan ranking mahasiswa menggunakan metode <strong>Profile Matching</strong>.<br>
    <small class="text-muted">Total = (60% × NCF) + (40% × NSF)</small></p>

    @if (!empty($error))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(empty($hasil) && empty($error))
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> Data belum tersedia. Silakan tambahkan data alternatif dan profile matching terlebih dahulu.
        </div>
    @endif

    @forelse ($hasil as $i => $h)
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-trophy fa-sm"></i>
                    Ranking {{ $i + 1 }} - {{ $h['nama'] }}
                    @if($i == 0)
                        <span class="badge badge-warning ml-2">Peringkat Teratas</span>
                    @endif
                </h6>
                <a href="{{ route('profile-matching.detail', $h['alternatif_id']) }}" class="btn btn-sm btn-info">
                    <i class="fas fa-eye"></i> Detail
                </a>
            </div>

            <div class="card-body">
                <!-- Tabel Perhitungan -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="table-{{ $i }}">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">Kriteria</th>
                                <th width="25%">Sub Kriteria (Mahasiswa)</th>
                                <th width="15%" class="text-center">Nilai Mhs</th>
                                <th width="15%" class="text-center">Nilai Standar</th>
                                <th width="10%" class="text-center">Gap</th>
                                <th width="10%" class="text-center">Bobot</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($h['rows'] as $idx => $r)
                                <tr>
                                    <td class="text-center">{{ $idx + 1 }}</td>
                                    <td>
                                        {{ $r['nama_kriteria'] }}
                                        @if($r['jenis'] == 'Core')
                                            <span class="badge badge-primary ml-2">Core</span>
                                        @else
                                            <span class="badge badge-success ml-2">Secondary</span>
                                        @endif
                                    </td>
                                    <td>{{ $r['nama_sub_mhs'] }}</td>
                                    <td class="text-center font-weight-bold">{{ $r['nilai_mhs'] }}</td>
                                    <td class="text-center">{{ $r['nilai_std'] }}</td>
                                    <td class="text-center">
                                        @php
                                            $gapClass = $r['gap'] < 0 ? 'text-danger' : ($r['gap'] > 0 ? 'text-success' : 'text-warning');
                                        @endphp
                                        <span class="{{ $gapClass }} font-weight-bold">
                                            {{ $r['gap'] >= 0 ? '+' : '' }}{{ $r['gap'] }}
                                        </span>
                                    </td>
                                    <td class="text-center font-weight-bold">{{ number_format($r['bobot'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Summary Cards -->
                <div class="row mt-4">
                    <div class="col-xl-4 col-md-6 mb-3">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            NCF (Core Factor)
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($h['ncf'], 4) }}
                                        </div>
                                        <small class="text-muted">Rata-rata bobot kriteria core</small>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-3">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            NSF (Secondary Factor)
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($h['nsf'], 4) }}
                                        </div>
                                        <small class="text-muted">Rata-rata bobot kriteria secondary</small>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-12 mb-3">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            TOTAL NILAI AKHIR
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($h['total'], 4) }}
                                        </div>
                                        <small class="text-muted">
                                            = (0.6 × {{ number_format($h['ncf'], 4) }}) + (0.4 × {{ number_format($h['nsf'], 4) }})
                                        </small>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calculator fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progress Bar Total Score -->
                <div class="mt-3">
                                    <div class="progress" style="height: 25px;">
                        @php
                            $persentase = ($h['total'] / 5) * 100;
                        @endphp
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-{{ $h['total'] >= 4 ? 'success' : ($h['total'] >= 3 ? 'warning' : 'danger') }}"
                             role="progressbar"
                             style="width: {{ $persentase }}%"
                             aria-valuenow="{{ $persentase }}"
                             aria-valuemin="0"
                             aria-valuemax="100">
                            {{ number_format($persentase, 1) }}%
                        </div>
                    </div>
                    <small class="text-muted">Skor maksimal: 5.00</small>
                </div>
            </div>
        </div>
    @empty
        @if(empty($error))
            <div class="alert alert-info text-center">
                <i class="fas fa-database fa-3x mb-3 d-block"></i>
                <h5>Belum Ada Data Perhitungan</h5>
                <p>Silakan tambahkan data alternatif, nilai, dan profile matching terlebih dahulu.</p>
            </div>
        @endif
    @endforelse


</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Optional: Initialize DataTable for ranking summary
        if ($('#rankingTable').length) {
            $('#rankingTable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                }
            });
        }
    });
</script>
@endpush
