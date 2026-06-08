@extends('layouts.app')

@section('title', 'Edit Data Alternatif')

@section('content')

    <div class="container-fluid">

        <!-- Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 text-gray-800">
                Edit Data Alternatif
            </h1>
        </div>

        <!-- Error Validation -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi Kesalahan!</strong>

                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <div class="card shadow mb-4">

            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary mr-auto">
                    Form Edit Data
                </h6>

                <a href="{{ route('alternatif.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i>
                    Kembali
                </a>

            </div>


            <div class="card-body">

                <form action="{{ route('alternatif.update', $alternatif->id_mhs) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>NIM</label>

                                <input type="text" name="nim" class="form-control"
                                    value="{{ old('nim', $alternatif->nim) }}" required>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Nama</label>

                                <input type="text" name="nama" class="form-control"
                                    value="{{ old('nama', $alternatif->nama) }}" required>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Jenis Kelamin</label>

                                <select name="jenis_kelamin" class="form-control" required>

                                    <option value="">-- Pilih --</option>

                                    <option value="Laki-laki"
                                        {{ old('jenis_kelamin', $alternatif->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>

                                    <option value="Perempuan"
                                        {{ old('jenis_kelamin', $alternatif->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>No HP</label>

                                <input type="text" name="no_hp" class="form-control"
                                    value="{{ old('no_hp', $alternatif->no_hp) }}" required>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Tempat Lahir</label>

                                <input type="text" name="tempat_lahir" class="form-control"
                                    value="{{ old('tempat_lahir', $alternatif->tempat_lahir) }}" required>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Tanggal Lahir</label>

                                <input type="date" name="tanggal_lahir" class="form-control"
                                    value="{{ old('tanggal_lahir', $alternatif->tanggal_lahir) }}" required>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Email</label>

                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $alternatif->email) }}" required>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Prodi</label>

                                <input type="text" name="prodi" class="form-control"
                                    value="{{ old('prodi', $alternatif->prodi) }}" required>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Fakultas</label>

                                <input type="text" name="fakultas" class="form-control"
                                    value="{{ old('fakultas', $alternatif->fakultas) }}" required>
                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">
                                <label>Angkatan</label>

                                <input type="number" name="angkatan" class="form-control"
                                    value="{{ old('angkatan', $alternatif->angkatan) }}" required>
                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">
                                <label>Semester</label>

                                <input type="number" name="semester" class="form-control"
                                    value="{{ old('semester', $alternatif->semester) }}" required>
                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">
                                <label>IPK</label>

                                <input type="number" step="0.01" name="ipk" class="form-control"
                                    value="{{ old('ipk', $alternatif->ipk) }}" required>
                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">
                                <label>Tanggungan</label>

                                <input type="number" name="jumlah_tanggungan" class="form-control"
                                    value="{{ old('jumlah_tanggungan', $alternatif->jumlah_tanggungan) }}" required>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Penghasilan Orang Tua</label>

                                <input type="number" name="penghasilan_orang_tua" class="form-control"
                                    value="{{ old('penghasilan_orang_tua', $alternatif->penghasilan_orang_tua) }}"
                                    required>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Status</label>

                                <select name="status" class="form-control" required>

                                    <option value="Aktif"
                                        {{ old('status', $alternatif->status) == 'Aktif' ? 'selected' : '' }}>
                                        Aktif
                                    </option>

                                    <option value="Tidak Aktif"
                                        {{ old('status', $alternatif->status) == 'Tidak Aktif' ? 'selected' : '' }}>
                                        Tidak Aktif
                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">
                                <label>Alamat</label>

                                <textarea name="alamat" rows="4" class="form-control" required>{{ old('alamat', $alternatif->alamat) }}</textarea>
                            </div>

                        </div>

                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary">

                        <i class="fas fa-save"></i>
                        Update Data

                    </button>

                </form>

            </div>
        </div>

    </div>

@endsection
