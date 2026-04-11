<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
<<<<<<< HEAD
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubKriteriaController;
=======
>>>>>>> 2b6e62b75c8b4e268fdc3905e84f1e4fa167bd64

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

<<<<<<< HEAD
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

// Route::get('/kriteria/reset-session', function () {
//     session()->forget('kriteria');
//     session()->forget('kriteria_last_id');
//     return redirect('/kriteria')->with('success', 'Session kriteria di-reset.');
// });

// /kriteria/reset-session
=======
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
>>>>>>> 2b6e62b75c8b4e268fdc3905e84f1e4fa167bd64
