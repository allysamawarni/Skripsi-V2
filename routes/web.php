<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemakaianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KomplainController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routess
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/barang', BarangController::class);
    Route::resource('/status', StatusController::class);
    Route::resource('/stok', StokController::class);
    Route::resource('/pemakaian', PemakaianController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/komplain', KomplainController::class);
    Route::resource('/pembelian', PembelianController::class);
    Route::resource('/event', EventController::class);
    Route::post('/komplain/reply/{id}', 'App\Http\Controllers\KomplainController@reply')->name('komplain.reply');
});

// Route::middleware(['auth:sanctum', 'verified'], ['role:ukm'])->group(function () {
//     Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// });
