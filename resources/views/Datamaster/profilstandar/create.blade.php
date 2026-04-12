@extends('layouts.app')
@section('title', 'Tambah Profil Standar')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-3 text-gray-800">Tambah Profil Standar</h1>
    <p class="mb-4">Form untuk menambah data profil standar.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Profil Standar</h6>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('profil-standar.store') }}">
                @csrf

                {{-- Include form --}}
                @include('datamaster.profilstandar._form', ['profil' => null])

                <div class="mt-3">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-save"></i> Simpan
                    </button>

                    <a class="btn btn-secondary" href="{{ route('profil-standar.index') }}">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
