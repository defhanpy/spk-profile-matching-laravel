@extends('layouts.app')
@section('title', 'Perankingan Profile Matching')

@section('content')

    <div class="container-fluid">

        <!-- Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 mb-1 text-gray-800">Perankingan Profile Matching</h1>
                <p class="mb-0 text-muted">
                    Hasil perhitungan ranking mahasiswa menggunakan metode Profile Matching.
                </p>
            </div>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        @if (session('error') || isset($error))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i> {{ session('error') ?? $error }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <!-- Card Tabel -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-list-ol"></i> Tabel Hasil Perankingan
                </h6>
                <a href="{{ route('profile-matching.index') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-chart-line"></i> Detail Profile Matching
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th width="60" class="text-center">Ranking</th>
                                <th>Nama Mahasiswa</th>
                                <th width="180" class="text-center">NCF (Core)</th>
                                <th width="180" class="text-center">NSF (Secondary)</th>
                                <th width="180" class="text-center">Total Skor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hasil as $index => $h)
                                <tr>
                                    <td class="text-center">
                                        @if ($index == 0)
                                            <span class="badge badge-warning px-3 py-2">
                                                <i class="fas fa-trophy"></i> {{ $index + 1 }}
                                            </span>
                                        @elseif($index == 1)
                                            <span class="badge badge-secondary px-3 py-2">
                                                <i class="fas fa-medal"></i> {{ $index + 1 }}
                                            </span>
                                        @elseif($index == 2)
                                            <span class="badge badge-danger px-3 py-2">
                                                <i class="fas fa-medal"></i> {{ $index + 1 }}
                                            </span>
                                        @else
                                            <span class="badge badge-light px-3 py-2">{{ $index + 1 }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $h['nama'] }}</strong><br>
                                        <small class="text-muted">{{ $h['nim'] }}</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-primary px-3 py-2">{{ number_format($h['ncf'], 2) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-info px-3 py-2">{{ number_format($h['nsf'], 2) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge badge-success px-3 py-2">{{ number_format($h['total'], 2) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fas fa-database fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum Ada Data</h5>
                                        <p class="text-muted">Silakan hitung nilai profil terlebih dahulu.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if (!empty($hasil) && count($hasil) > 0)
                            <tfoot class="thead-light">
                                <tr>
                                    <th colspan="4" class="text-right">Total Mahasiswa:</th>
                                    <th class="text-center">{{ count($hasil) }}</th>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <!-- Card Ringkasan -->
        @if (!empty($hasil) && count($hasil) > 0)
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow mb-4 border-left-warning">
                        <div class="card-body text-center">
                            <i class="fas fa-trophy fa-3x text-warning mb-2"></i>
                            <h6 class="text-uppercase text-muted">Peringkat 1</h6>
                            <h5 class="mb-0 font-weight-bold">{{ $hasil[0]['nama'] }}</h5>
                            <small class="text-muted">Skor: {{ number_format($hasil[0]['total'], 2) }}</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-4 border-left-success">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-line fa-3x text-success mb-2"></i>
                            <h6 class="text-uppercase text-muted">Rata-rata Skor</h6>
                            <h5 class="mb-0 font-weight-bold">{{ number_format(collect($hasil)->avg('total'), 2) }}</h5>
                            <small class="text-muted">Dari {{ count($hasil) }} mahasiswa</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-4 border-left-info">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-bar fa-3x text-info mb-2"></i>
                            <h6 class="text-uppercase text-muted">Skor Tertinggi</h6>
                            <h5 class="mb-0 font-weight-bold">{{ number_format(collect($hasil)->max('total'), 2) }}</h5>
                            <small class="text-muted">Terendah:
                                {{ number_format(collect($hasil)->min('total'), 2) }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
