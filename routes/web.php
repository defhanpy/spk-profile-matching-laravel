<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\ProfilStandarController;
use App\Http\Controllers\NilaiProfilController;
use App\Http\Controllers\ProfileMatchingController;
use App\Http\Controllers\RankingController;

use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'login'])->name('login');

// proses login
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
// logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ALL SYSTEM ROUTES (PROTECTED)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |-------------------------
    | DASHBOARD
    |-------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |-------------------------
    | KRITERIA
    |-------------------------
    */
    Route::prefix('kriteria')->name('kriteria.')->group(function () {
        Route::get('/', [KriteriaController::class, 'index'])->name('index');
        Route::get('/create', [KriteriaController::class, 'create'])->name('create');
        Route::post('/', [KriteriaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [KriteriaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KriteriaController::class, 'update'])->name('update');
        Route::delete('/{id}', [KriteriaController::class, 'destroy'])->name('destroy');
    });

    /*
    |-------------------------
    | SUB KRITERIA
    |-------------------------
    */
    Route::prefix('subkriteria')->name('subkriteria.')->group(function () {
        Route::get('/', [SubKriteriaController::class, 'index'])->name('index');
        Route::get('/create', [SubKriteriaController::class, 'create'])->name('create');
        Route::post('/', [SubKriteriaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SubKriteriaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SubKriteriaController::class, 'update'])->name('update');
        Route::delete('/{id}', [SubKriteriaController::class, 'destroy'])->name('destroy');
    });

    /*
    |-------------------------
    | ALTERNATIF
    |-------------------------
    */
    Route::prefix('alternatif')->name('alternatif.')->group(function () {
        Route::get('/', [AlternatifController::class, 'index'])->name('index');
        Route::get('/create', [AlternatifController::class, 'create'])->name('create');
        Route::post('/', [AlternatifController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AlternatifController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AlternatifController::class, 'update'])->name('update');
        Route::delete('/{id}', [AlternatifController::class, 'destroy'])->name('destroy');
    });

    /*
    |-------------------------
    | PROFIL STANDAR
    |-------------------------
    */
    Route::prefix('profilstandar')->name('profilstandar.')->group(function () {
        Route::get('/', [ProfilStandarController::class, 'index'])->name('index');
        Route::get('/create', [ProfilStandarController::class, 'create'])->name('create');
        Route::post('/', [ProfilStandarController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProfilStandarController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProfilStandarController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProfilStandarController::class, 'destroy'])->name('destroy');
    });

    /*
    |-------------------------
    | NILAI PROFIL STANDAR
    |-------------------------
    */
    Route::prefix('nilaiprofil')->name('nilaiprofil.')->group(function () {

        Route::get('/', [NilaiProfilController::class, 'index'])->name('index');
        Route::get('/create', [NilaiProfilController::class, 'create'])->name('create');
        Route::post('/', [NilaiProfilController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [NilaiProfilController::class, 'edit'])->name('edit');
        Route::put('/{id}', [NilaiProfilController::class, 'update'])->name('update');
        Route::delete('/{id}', [NilaiProfilController::class, 'destroy'])->name('destroy');
        Route::post('/hitung', [NilaiProfilController::class, 'hitung'])->name('hitung');
        Route::post('/clear', [NilaiProfilController::class, 'clear'])->name('clear');
    });

    /*
    |-------------------------
    | PERHITUNGAN PROFILE MATCHING
    |-------------------------
    */
    Route::prefix('profile-matching')->name('profile-matching.')->group(function () {
        Route::get('/', [ProfileMatchingController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [ProfileMatchingController::class, 'detail'])->name('detail');
    });

Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');
Route::get('/ranking/detail/{id}', [RankingController::class, 'detail'])->name('ranking.detail');

});



