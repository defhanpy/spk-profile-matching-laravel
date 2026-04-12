@extends('layouts.app')
@section('title', 'Nilai Profil Mahasiswa')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Nilai Profil Mahasiswa</h1>
    <p class="mb-4">Berikut adalah data nilai profil mahasiswa.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Nilai Profil</h6>
            {{-- optional tombol tambah --}}
            {{-- <a href="#" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Data
            </a> --}}
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:70px;">No</th>
                            <th>Mahasiswa</th>
                            <th style="width:220px;">Kriteria</th>
                            <th>Sub Kriteria</th>
                            <th style="width:140px;">Nilai Profil</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $grouped = collect($rows)->groupBy('mhs_id');
                        @endphp

                        @forelse($grouped as $mhsId => $items)
                            @php
                                $first = true;
                                $rowspan = $items->count();
                            @endphp

                            @foreach($items as $r)
                                <tr>
                                    @if($first)
                                        <td rowspan="{{ $rowspan }}">{{ $r['no'] }}</td>
                                        <td rowspan="{{ $rowspan }}">
                                            <strong>{{ $r['nama_mhs'] }}</strong>
                                        </td>
                                        @php $first = false; @endphp
                                    @endif

                                    <td>{{ $r['kriteria_id'] }}. {{ $r['nama_kriteria'] }}</td>
                                    <td>
                                        @if($r['sub_id'])
                                            {{ $r['sub_id'] }}. {{ $r['nama_sub'] }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $r['nilai_profil'] ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>
    </div>

</div>
@endsection
