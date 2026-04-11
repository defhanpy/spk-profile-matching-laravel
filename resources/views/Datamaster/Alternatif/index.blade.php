@extends('layouts.app')
@section('title', 'Data Alternatif')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Data Alternatif</h1>
    <p class="mb-4">Berikut data alternatif (simulasi session).</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Alternatif</h6>
            <a href="{{ route('alternatif.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Data Alternatif
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Prodi</th>
                            <th>Semester</th>
                            <th>IPK</th>
                            <th>Penghasilan Ortu</th>
                            <th>Tanggungan</th>
                            <th>Status</th>
                            <th style="width:120px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($alternatif as $i => $m)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $m['nim'] }}</td>
                            <td>{{ $m['nama'] }}</td>
                            <td>{{ $m['jenis_kelamin'] }}</td>
                            <td>{{ $m['prodi'] }}</td>
                            <td>{{ $m['semester'] }}</td>
                            <td>{{ number_format((float)$m['ipk'], 2) }}</td>
                            <td>Rp {{ number_format((int)$m['penghasilan_orang_tua'], 0, ',', '.') }}</td>
                            <td>{{ $m['jumlah_tanggungan'] }}</td>
                            <td>{{ $m['status'] }}</td>
                            <td class="d-flex" style="gap:6px;">
                                <a href="{{ route('alternatif.edit', $m['id_mhs']) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('alternatif.destroy', $m['id_mhs']) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data alternatif ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
@endsection
