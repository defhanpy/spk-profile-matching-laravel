@extends('layouts.app')
@section('title', 'Edit Data Alternatif')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-3 text-gray-800">Edit Data Alternatif</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Data Alternatif</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('alternatif.update', $mhs['id_mhs']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>NIM</label>
                            <input type="text" name="nim" value="{{ old('nim', $mhs['nim']) }}" class="form-control">
                            @error('nim') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" value="{{ old('nama', $mhs['nama']) }}" class="form-control">
                            @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="Laki-laki" {{ old('jenis_kelamin', $mhs['jenis_kelamin'])=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $mhs['jenis_kelamin'])=='Perempuan'?'selected':'' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $mhs['tempat_lahir']) }}" class="form-control">
                            @error('tempat_lahir') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $mhs['tanggal_lahir']) }}" class="form-control">
                            @error('tanggal_lahir') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>No HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $mhs['no_hp']) }}" class="form-control">
                            @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email', $mhs['email']) }}" class="form-control">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Alamat</label>
                            <input type="text" name="alamat" value="{{ old('alamat', $mhs['alamat']) }}" class="form-control">
                            @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Prodi</label>
                            <input type="text" name="prodi" value="{{ old('prodi', $mhs['prodi']) }}" class="form-control">
                            @error('prodi') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Fakultas</label>
                            <input type="text" name="fakultas" value="{{ old('fakultas', $mhs['fakultas']) }}" class="form-control">
                            @error('fakultas') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Angkatan</label>
                            <input type="number" name="angkatan" value="{{ old('angkatan', $mhs['angkatan']) }}" class="form-control" min="2000" max="2100">
                            @error('angkatan') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Semester</label>
                            <input type="number" name="semester" value="{{ old('semester', $mhs['semester']) }}" class="form-control" min="1" max="14">
                            @error('semester') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="Aktif" {{ old('status', $mhs['status'])=='Aktif'?'selected':'' }}>Aktif</option>
                                <option value="Nonaktif" {{ old('status', $mhs['status'])=='Nonaktif'?'selected':'' }}>Nonaktif</option>
                            </select>
                            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>IPK</label>
                            <input type="number" name="ipk" value="{{ old('ipk', $mhs['ipk']) }}" class="form-control" step="0.01" min="0" max="4">
                            @error('ipk') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Penghasilan Orang Tua</label>
                            <input type="number" name="penghasilan_orang_tua" value="{{ old('penghasilan_orang_tua', $mhs['penghasilan_orang_tua']) }}" class="form-control" min="0">
                            @error('penghasilan_orang_tua') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label>Jumlah Tanggungan</label>
                            <input type="number" name="jumlah_tanggungan" value="{{ old('jumlah_tanggungan', $mhs['jumlah_tanggungan']) }}" class="form-control" min="0" max="20">
                            @error('jumlah_tanggungan') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('alternatif.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
