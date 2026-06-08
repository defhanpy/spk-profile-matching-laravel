@extends('layouts.app')

@section('title', 'Data Alternatif')

@section('content')

    <div class="container-fluid">

        <!-- Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <div>
                <h1 class="h3 mb-1 text-gray-800">
                    Data Alternatif
                </h1>

                <p class="mb-0 text-muted">
                    Daftar data mahasiswa alternatif SPK.
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
                    Tabel Alternatif
                </h6>

                <a href="{{ route('alternatif.create') }}" class="btn btn-primary btn-sm">

                    <i class="fas fa-plus"></i>
                    Tambah Alternatif

                </a>

            </div>

            <!-- Body -->
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>TTL</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Prodi</th>
                                <th>Fakultas</th>
                                <th>Angkatan</th>
                                <th>Semester</th>
                                <th>IPK</th>
                                <th>Penghasilan Orang Tua</th>
                                <th>Jumlah Tanggungan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($alternatif as $index => $item)
                                <tr>
                                    <td class="text-center">
                                        {{ $index + 1 }}
                                    </td>
                                    <td>{{ $item->nim }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->tempat_lahir }},
                                        {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d M Y') }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->prodi }}</td>
                                    <td>{{ $item->fakultas }}</td>
                                    <td>{{ $item->angkatan }}</td>
                                    <td>{{ $item->semester }}</td>
                                    <td>{{ $item->ipk }}</td>
                                    <td>{{ $item->penghasilan_orang_tua }}</td>
                                    <td>{{ $item->jumlah_tanggungan }}</td>
                                    <td><span
                                            class="badge {{ $item->status == 'Aktif' ? 'badge-success' : 'badge-secondary' }}">{{ $item->status }}</span>
                                    </td>
                                    <td class="text-center">

                                        <div class="d-flex justify-content-center" style="gap:6px;">

                                            <a href="{{ route('alternatif.edit', $item->id_mhs) }}"
                                                class="btn btn-warning btn-sm">

                                                <i class="fas fa-edit"></i>

                                            </a>
                                            <!-- Tombol Hapus -->
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#hapusAlternatifModal{{ $item->id_mhs }}">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                            <!-- Modal Hapus Alternatif -->
                                            <div class="modal fade" id="hapusAlternatifModal{{ $item->id_mhs }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="hapusAlternatifLabel{{ $item->id_mhs }}"
                                                aria-hidden="true">

                                                <div class="modal-dialog modal-dialog-centered" role="document">

                                                    <div class="modal-content">

                                                        <!-- HEADER -->
                                                        <div class="modal-header bg-danger text-white">

                                                            <h5 class="modal-title"
                                                                id="hapusAlternatifLabel{{ $item->id_mhs }}">
                                                                Konfirmasi Hapus Data
                                                            </h5>

                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>

                                                        </div>

                                                        <!-- BODY -->
                                                        <div class="modal-body text-center">

                                                            <i
                                                                class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>

                                                            <h5>Yakin ingin menghapus data ini?</h5>

                                                            <p class="text-muted mb-0">
                                                                Data alternatif dengan nama
                                                                <strong>{{ $item->nama }}</strong> akan dihapus secara
                                                                permanen.
                                                            </p>

                                                        </div>

                                                        <!-- FOOTER -->
                                                        <div class="modal-footer">

                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">
                                                                Batal
                                                            </button>

                                                            <form action="{{ route('alternatif.destroy', $item->id_mhs) }}"
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

                                    <td colspan="17" class="text-center text-muted">
                                        Data belum tersedia
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
