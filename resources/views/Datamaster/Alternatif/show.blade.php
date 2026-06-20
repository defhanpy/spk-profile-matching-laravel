@extends('layouts.app')

@section('title', 'Detail Data Alternatif')

@section('content')

    <div class="container-fluid">

        <!-- Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 mb-1 text-gray-800">
                    Detail Data Alternatif
                </h1>
                <p class="mb-0 text-muted">
                    Informasi lengkap mahasiswa alternatif SPK.
                </p>
            </div>
        </div>

        <div class="row">
            <!-- Profile Card Sidebar (Col-md-4) -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center shadow-sm font-weight-bold" style="width: 100px; height: 100px; font-size: 40px; text-transform: uppercase;">
                                {{ substr($alternatif->nama, 0, 1) }}
                            </div>
                        </div>
                        <h5 class="font-weight-bold text-gray-900 mb-1">{{ $alternatif->nama }}</h5>
                        <p class="text-muted mb-3">{{ $alternatif->nim }}</p>
                        
                        <div class="badge badge-pill {{ $alternatif->status == 'Aktif' ? 'badge-success' : 'badge-secondary' }} px-3 py-2 font-weight-bold mb-4" style="font-size: 14px;">
                            Status: {{ $alternatif->status }}
                        </div>

                        <hr>

                        <div class="text-left mt-3">
                            <p class="mb-2"><strong><i class="fas fa-university text-primary mr-2"></i> Program Studi:</strong><br><span class="text-muted pl-4">{{ $alternatif->prodi }}</span></p>
                            <p class="mb-2"><strong><i class="fas fa-graduation-cap text-primary mr-2"></i> Fakultas:</strong><br><span class="text-muted pl-4">{{ $alternatif->fakultas }}</span></p>
                            <p class="mb-0"><strong><i class="fas fa-calendar-alt text-primary mr-2"></i> Angkatan:</strong><br><span class="text-muted pl-4">{{ $alternatif->angkatan }}</span></p>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light">
                        <a href="{{ route('alternatif.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <a href="{{ route('alternatif.edit', $alternatif->id_mhs) }}" class="btn btn-warning btn-sm shadow-sm">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile Details Content (Col-md-8) -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-user-circle mr-2"></i> Biodata Lengkap
                        </h6>
                    </div>
                    <div class="card-body">
                        <!-- Personal Info -->
                        <h6 class="text-primary font-weight-bold text-uppercase mb-3" style="font-size: 12px; letter-spacing: 1px;">
                            Informasi Pribadi
                        </h6>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted font-weight-bold">Nama Lengkap</div>
                            <div class="col-md-8 text-gray-900">{{ $alternatif->nama }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted font-weight-bold">NIM</div>
                            <div class="col-md-8 text-gray-900">{{ $alternatif->nim }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted font-weight-bold">Jenis Kelamin</div>
                            <div class="col-md-8 text-gray-900">{{ $alternatif->jenis_kelamin }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted font-weight-bold">Tempat, Tanggal Lahir</div>
                            <div class="col-md-8 text-gray-900">
                                {{ $alternatif->tempat_lahir }}, {{ date('d-m-Y', strtotime($alternatif->tanggal_lahir)) }}
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Contact Info -->
                        <h6 class="text-primary font-weight-bold text-uppercase mb-3" style="font-size: 12px; letter-spacing: 1px;">
                            Kontak & Alamat
                        </h6>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted font-weight-bold">Email</div>
                            <div class="col-md-8 text-gray-900">{{ $alternatif->email }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted font-weight-bold">No. Handphone</div>
                            <div class="col-md-8 text-gray-900">{{ $alternatif->no_hp }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted font-weight-bold">Alamat</div>
                            <div class="col-md-8 text-gray-900">{{ $alternatif->alamat }}</div>
                        </div>

                        <hr class="my-4">

                        <!-- Academic Info -->
                        <h6 class="text-primary font-weight-bold text-uppercase mb-3" style="font-size: 12px; letter-spacing: 1px;">
                            Akademik & Kriteria SPK
                        </h6>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted font-weight-bold">IPK Terakhir</div>
                            <div class="col-md-8 text-gray-900 font-weight-bold">
                                <span class="bg-light px-2 py-1 border rounded">{{ $alternatif->ipk }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted font-weight-bold">Semester</div>
                            <div class="col-md-8 text-gray-900">{{ $alternatif->semester }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted font-weight-bold">Penghasilan Orang Tua</div>
                            <div class="col-md-8 text-gray-900">
                                Rp {{ number_format($alternatif->penghasilan_orang_tua, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted font-weight-bold">Jumlah Tanggungan</div>
                            <div class="col-md-8 text-gray-900">{{ $alternatif->jumlah_tanggungan }} Orang</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
