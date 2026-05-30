<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BerandaWargaController;
use App\Http\Controllers\BerandaAdminController;
use App\Http\Controllers\InputDataLahanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\MenuDataInputWargaController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;

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

// LANDING
Route::get('/', [AuthController::class, 'showLanding'])->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginWarga'])->name('login');
    Route::get('/login/admin', [AuthController::class, 'showLoginAdmin'])->name('login.admin');
    Route::post('/login', [AuthController::class, 'loginWarga']);
    Route::post('/login/admin', [AuthController::class, 'loginAdmin']);
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// WARGA
Route::middleware(['auth', 'role:user'])
    ->prefix('warga')
    ->name('warga.')
    ->group(function () {
        Route::get('/beranda', [BerandaWargaController::class, 'index'])->name('beranda');
        Route::get('/input-lahan', [InputDataLahanController::class, 'tampilkanForm'])->name('input.form');
        Route::post('/input-lahan', [InputDataLahanController::class, 'simpanInput'])->name('input.simpan');
        Route::get('/riwayat', [RiwayatController::class, 'tampilkanRiwayat'])->name('riwayat');
        Route::get('/riwayat/{id}', [RiwayatController::class, 'tampilkanDetail'])->name('riwayat.detail');
        Route::get('/profil', [ProfileController::class, 'showWarga'])->name('profil');
        Route::post('/profil', [ProfileController::class, 'update'])->name('profil.update');
    });


// ADMIN
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/beranda', [BerandaAdminController::class, 'index'])->name('beranda');
        // Route::resource('/kriteria', KriteriaController::class);
        Route::resource('kriteria', KriteriaController::class)
            ->parameters([
                'kriteria' => 'kriteria'
            ]);
        Route::resource('/tanaman', AlternatifController::class);
        Route::get('/data-warga', [MenuDataInputWargaController::class, 'index'])->name('data-warga');
        Route::get('/data-warga/{id}', [MenuDataInputWargaController::class, 'tampilkanDetail'])->name('data-warga.detail');
        Route::get('/profil', [ProfileController::class, 'showAdmin'])->name('profil');
        Route::post('/profil', [ProfileController::class, 'update'])->name('profil.update');
    });