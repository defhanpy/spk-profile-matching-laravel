@extends('layouts.app')
@section('title', 'Perankingan Profile Matching')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Perankingan (Profile Matching)</h1>
    <p class="mb-4">Berikut adalah hasil perankingan berdasarkan metode Profile Matching.</p>

    @if(!empty($error))
        <div class="alert alert-warning">{{ $error }}</div>
    @endif

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Ranking</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:80px;" class="text-center">Rank</th>
                            <th>Mahasiswa</th>
                            <th style="width:160px;" class="text-center">NCF</th>
                            <th style="width:160px;" class="text-center">NSF</th>
                            <th style="width:160px;" class="text-center">Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($ranking as $r)
                            <tr>
                                <td class="text-center">
                                    <strong>{{ $r['rank'] }}</strong>
                                </td>
                                <td>
                                    <strong>{{ $r['nama'] }}</strong><br>
                                    <small class="text-muted">{{ $r['nim'] }}</small>
                                </td>
                                <td class="text-center">{{ number_format($r['ncf'], 2) }}</td>
                                <td class="text-center">{{ number_format($r['nsf'], 2) }}</td>
                                <td class="text-center">
                                    <strong>{{ number_format($r['total'], 2) }}</strong>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

            {{-- Notasi nilai tertinggi --}}
            @php
                $top = !empty($ranking) ? $ranking[0] : null;
            @endphp

            @if($top)
                <div class="mt-3 alert alert-success">
                    <strong>Nilai tertinggi diperoleh:</strong>
                    {{ $top['nama'] }}
                    ({{ $top['nim'] }})
                    dengan total nilai
                    <strong>{{ number_format($top['total'], 2) }}</strong>.
                </div>
            @endif

        </div>

    </div>

</div>
@endsection
