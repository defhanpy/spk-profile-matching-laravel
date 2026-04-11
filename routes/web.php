<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\AlternatifController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
Route::get('/kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');

Route::get('/kriteria/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
Route::put('/kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');

Route::delete('/kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');


Route::get('/subkriteria', [SubKriteriaController::class, 'index'])->name('subkriteria.index');
Route::get('/subkriteria/create', [SubKriteriaController::class, 'create'])->name('subkriteria.create');
Route::post('/subkriteria', [SubKriteriaController::class, 'store'])->name('subkriteria.store');

Route::get('/subkriteria/{id}/edit', [SubKriteriaController::class, 'edit'])->name('subkriteria.edit');
Route::put('/subkriteria/{id}', [SubKriteriaController::class, 'update'])->name('subkriteria.update');

Route::delete('/subkriteria/{id}', [SubKriteriaController::class, 'destroy'])->name('subkriteria.destroy');


Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
Route::get('/alternatif/create', [AlternatifController::class, 'create'])->name('alternatif.create');
Route::post('/alternatif', [AlternatifController::class, 'store'])->name('alternatif.store');

Route::get('/alternatif/{id}/edit', [AlternatifController::class, 'edit'])->name('alternatif.edit');
Route::put('/alternatif/{id}', [AlternatifController::class, 'update'])->name('alternatif.update');

Route::delete('/alternatif/{id}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy');

// Route::get('/kriteria/reset-session', function () {
//     session()->forget('kriteria');
//     session()->forget('kriteria_last_id');
//     return redirect('/kriteria')->with('success', 'Session kriteria di-reset.');
// });

// /kriteria/reset-session
