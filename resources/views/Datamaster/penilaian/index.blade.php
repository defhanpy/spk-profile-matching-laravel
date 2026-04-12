@extends('layouts.app')
@section('title', 'Perhitungan Profile Matching')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Perhitungan Metode Profile Matching</h1>
    <p class="mb-4">Berikut adalah hasil perhitungan berdasarkan metode Profile Matching.</p>

    @if(!empty($error))
        <div class="alert alert-warning">{{ $error }}</div>
    @endif

    @foreach($hasil as $i => $h)
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ $i+1 }}. {{ $h['nama'] }}
                </h6>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>Kriteria</th>
                                <th>Sub Kriteria (Profil Mhs)</th>
                                <th class="text-center">Nilai Profil Mahasiswa</th>
                                <th class="text-center">Nilai Profil Standar</th>
                                <th class="text-center">Gap</th>
                                <th class="text-center">Nilai Gap</th>
                                <th class="text-center">Jenis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($h['rows'] as $r)
                                <tr>
                                    <td>{{ $r['kriteria_id'] }}. {{ $r['nama_kriteria'] }}</td>
                                    <td>
                                        @if($r['sub_id'])
                                            {{ $r['sub_id'] }}. {{ $r['nama_sub'] }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $r['nilai_mhs'] ?? '-' }}</td>
                                    <td class="text-center">{{ $r['nilai_std'] ?? '-' }}</td>
                                    <td class="text-center">{{ $r['gap'] ?? '-' }}</td>
                                    <td class="text-center">{{ $r['nilai_gap'] ?? '-' }}</td>
                                    <td class="text-center">
                                        {{ $r['jenis'] === 'Core Factor' ? 'Core (60%)' : 'Secondary (40%)' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Ringkasan Nilai -->
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    NCF (Core Factor)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($h['ncf'], 2) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    NSF (Secondary Factor)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($h['nsf'], 2) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Nilai
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($h['total'], 2) }}
                                </div>
                                <small class="text-muted">
                                    Total = (0.6 × NCF) + (0.4 × NSF)
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endforeach

</div>
@endsection
