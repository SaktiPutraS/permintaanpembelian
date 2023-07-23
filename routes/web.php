<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\BahanbakuController;
use App\Http\Controllers\AtkController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PermintaanbbController;
use App\Http\Controllers\PermintaanatkController;
use App\Http\Controllers\PesananpembelianController;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User =====================================================================================
Route::get('user', [UserController::class, 'index']);
Route::post('user/save', [UserController::class, 'save']);
Route::post('user/update', [UserController::class, 'update']);
Route::get('user/delete/{id}', [UserController::class, 'delete']);

// Karyawan =================================================================================
Route::get('karyawan', [KaryawanController::class, 'index']);
Route::post('karyawan/save', [KaryawanController::class, 'save']);
Route::post('karyawan/update', [KaryawanController::class, 'update']);
Route::get('karyawan/delete/{id}', [KaryawanController::class, 'delete']);

// Jabatan ==================================================================================
Route::get('jabatan', [JabatanController::class, 'index']);
Route::post('jabatan/save', [JabatanController::class, 'save']);
Route::post('jabatan/update', [JabatanController::class, 'update']);
Route::get('jabatan/delete/{id}', [JabatanController::class, 'delete']);

// Bahan Baku ===============================================================================
Route::get('bahanbaku', [BahanbakuController::class, 'index']);
Route::post('bahanbaku/save', [BahanbakuController::class, 'save']);
Route::post('bahanbaku/update', [BahanbakuController::class, 'update']);
Route::get('bahanbaku/delete/{id}', [BahanbakuController::class, 'delete']);

// ATK ======================================================================================
Route::get('atk', [AtkController::class, 'index']);
Route::post('atk/save', [AtkController::class, 'save']);
Route::post('atk/update', [AtkController::class, 'update']);
Route::get('atk/delete/{id}', [AtkController::class, 'delete']);

// Supplier ======================================================================================
Route::get('pemasok', [PemasokController::class, 'index']);
Route::post('pemasok/save', [PemasokController::class, 'save']);
Route::post('pemasok/update', [PemasokController::class, 'update']);
Route::get('pemasok/delete/{id}', [PemasokController::class, 'delete']);

// Permintaan Bahan Baku ====================================================================
Route::get('permintaanbb', [PermintaanbbController::class, 'index']);
Route::get('permintaanbb/create', [PermintaanbbController::class, 'create']);
Route::post('permintaanbb/save', [PermintaanbbController::class, 'save']);
Route::get('permintaanbb/edit/{id}', [PermintaanbbController::class, 'edit']);
Route::get('permintaanbb/delete/{id}', [PermintaanbbController::class, 'delete']);
Route::get('permintaanbb/delete/{id}/{kd_bahanbaku}', [PermintaanbbController::class, 'deletebarang']);

// Permintaan ATK ============================================================================
Route::get('permintaanatk', [PermintaanatkController::class, 'index']);
Route::get('permintaanatk/create', [PermintaanatkController::class, 'create']);
Route::post('permintaanatk/save', [PermintaanatkController::class, 'save']);
Route::get('permintaanatk/edit/{id}', [PermintaanatkController::class, 'edit']);
Route::get('permintaanatk/delete/{id}', [PermintaanatkController::class, 'delete']);
Route::get('permintaanatk/delete/{id}/{kd_bahanbaku}', [PermintaanatkController::class, 'deletebarang']);

// Pesanan Pembelian ====================================================================
Route::get('pesananpembelian', [PesananpembelianController::class, 'index']);
Route::get('pesananpembelian/create', [PesananpembelianController::class, 'create']);
Route::post('pesananpembelian/save', [PesananpembelianController::class, 'save']);
Route::get('pesananpembelian/edit/{id}', [PesananpembelianController::class, 'edit']);
Route::get('pesananpembelian/delete/{id}', [PesananpembelianController::class, 'delete']);
Route::get('pesananpembelian/delete/{id}/{kd_bahanbaku}', [PesananpembelianController::class, 'deletebarang']);
