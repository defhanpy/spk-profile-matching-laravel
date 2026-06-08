@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <x-breadcrumb :items="[]" />

        <!-- konten dashboard -->
    </div>
    <div class="container-fluid">

        <!-- Cards -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Alternatif</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahAlternatif }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Jumlah Kriteria</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahKriteria }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Core Factor</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahKriteriaCore }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-star fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Secondary Factor</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahKriteriaSecondary }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ranking Terbaik -->
        @if ($rankingTerbaik)
            <div class="row">
                <div class="col-xl-12 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2 bg-gradient-warning text-white">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <i class="fas fa-trophy"></i> Peringkat Terbaik
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold">
                                        {{ $rankingTerbaik->nama }} ({{ $rankingTerbaik->nim }})
                                    </div>
                                    <div class="small mt-2">
                                        Rata-rata Nilai: {{ $rankingTerbaik->rata_rata }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-crown fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Top 5 Peringkat -->
        <div class="row">
            <div class="col-xl-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">5 Besar Peringkat Mahasiswa</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Peringkat</th>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Rata-rata Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topFive as $index => $item)
                                        <tr>
                                            <td>
                                                @if ($index == 0)
                                                    1
                                                @elseif($index == 1)
                                                    2
                                                @elseif($index == 2)
                                                    3
                                                @else
                                                    {{ $index + 1 }}
                                                @endif
                                            </td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->nim }}</td>
                                            <td>{{ number_format($item->rata_rata, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
