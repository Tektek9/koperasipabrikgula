<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RabTahunanController;
use App\Http\Controllers\SaldoAwalController;
use App\Http\Controllers\DataKasBankController;
use App\Http\Controllers\MemorialController;
use App\Http\Controllers\SuplementController;
use App\Http\Controllers\PenutupController;
use App\Http\Controllers\LabaRugiController;
use App\Http\Controllers\LembarPemeriksaanController;
use App\Http\Controllers\BukuBesarController;
use App\Http\Controllers\SeluruhKartuBukuBesarController;
use App\Http\Controllers\NeracaAktifaPasifaController;
use App\Http\Controllers\NeracaController;
use App\Http\Controllers\NeracaLajurController;
use App\Http\Controllers\RincianBiayaController;
use App\Http\Controllers\RekeningKoranController;
use App\Http\Controllers\MemorialSaldoAwalController;
use App\Http\Controllers\MemorialPemindahBukuanController;
use App\Http\Controllers\LaporanManagementController;
use App\Http\Controllers\NomorPerkiraanController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('rab_tahunans', RabTahunanController::class);
Route::post('/import/rab_tahunan', [RabTahunanController::class,'import']);

Route::resource('saldo_awals', SaldoAwalController::class);
Route::get('saldo_awal/{nomor}', [SaldoAwalController::class,'index2']);
Route::post('/import/saldo_awal', [SaldoAwalController::class,'import']);

Route::resource('data_kas_banks', DataKasBankController::class);
Route::get('/api/data_kas_banks/{no_bukti}', [DataKasBankController::class,'index2']);
Route::get('/data_kas_banks/edit/{no_bukti}', [DataKasBankController::class,'edit2']);
Route::get('/data_kas_banks/delete/{id}', [DataKasBankController::class,'destroy']);
Route::get('/data_kas_banks/hapus/{id}', [DataKasBankController::class,'destroy2']);
Route::post('/import/data_kas_bank', [DataKasBankController::class,'import']);

Route::resource('memorials', MemorialController::class);
Route::get('api/memorials/{no_bukti}', [MemorialController::class,'index2']);
Route::get('/memorials/edit/{no_bukti}', [MemorialController::class,'edit2']);
Route::get('/memorials/delete/{id}', [MemorialController::class,'destroy']);
Route::get('/memorials/hapus/{id}', [MemorialController::class,'destroy2']);
Route::post('/import/memorial', [MemorialController::class,'import']);

Route::resource('suplements', SuplementController::class);
Route::get('api/suplements/{no_bukti}', [SuplementController::class,'index2']);
Route::get('/suplements/edit/{no_bukti}', [SuplementController::class,'edit2']);
Route::get('/suplements/delete/{id}', [SuplementController::class,'destroy']);
Route::get('/suplements/hapus/{id}', [SuplementController::class,'destroy2']);

Route::resource('penutups', PenutupController::class);
Route::get('api/penutups/{no_bukti}', [PenutupController::class,'index2']);
Route::get('/penutups/edit/{no_bukti}', [penutupController::class,'edit2']);
Route::get('/penutups/delete/{id}', [penutupController::class,'destroy']);
Route::get('/penutups/hapus/{id}', [penutupController::class,'destroy2']);

Route::resource('nomor_perkiraans', NomorPerkiraanController::class);
route::get('/nomor_perkiraan/search',[NomorPerkiraanController::class,'cari']);
Route::post('/import/no_perkiraan', [NomorPerkiraanController::class,'import']);
Route::get('/get-nama-perkiraan/{nomorPerkiraan}', [NomorPerkiraanController::class,'getNamaPerkiraan']);

route::get("/cetak/laba_rugi",[LabaRugiController::class,'index']);
route::get("/cetak/laba_rugi/view",[LabaRugiController::class,'indexview']);
route::get("/cetak/lembar_pemeriksaan",[LembarPemeriksaanController::class,'index']);
route::get("/cetak/lembar_pemeriksaan/view",[LembarPemeriksaanController::class,'indexview']);
route::get("/cetak/buku_besar",[BukuBesarController::class,'index']);
route::get("/cetak/buku_besar/view",[BukuBesarController::class,'indexview']);
// route::get("/cetak/buku_besar/urut_no_perkiraan",[BukuBesarController::class,'index']);
// route::get("/cetak/buku_besar/urut_tanggal",[BukuBesarController::class,'index2']);
// route::get("/cetak/buku_besar/urut_no_perkiraan/view",[BukuBesarController::class,'indexview']);
route::get("/cetak/seluruh_kartu_bukubesar",[SeluruhKartuBukuBesarController::class,'index']);
route::get("/cetak/seluruh_kartu_bukubesar/view",[SeluruhKartuBukuBesarController::class,'indexview']);
route::get("/cetak/neraca",[NeracaController::class,'index']);
route::get("/cetak/neraca/view",[NeracaController::class,'indexview']);
route::get("/cetak/neraca_aktifa_pasifa",[NeracaAktifaPasifaController::class,'index']);
route::get("/cetak/neraca_aktifa_pasifa/view",[NeracaAktifaPasifaController::class,'indexview']);
route::get("/cetak/neraca_lajur",[NeracaLajurController::class,'index']);
route::get("/cetak/neraca_lajur/view",[NeracaLajurController::class,'indexview']);
route::get("/cetak/rincian_biaya",[RincianBiayaController::class,'index']);
route::get("/cetak/rincian_biaya/view",[RincianBiayaController::class,'indexview']);
route::get("/cetak/rekening_koran/urut_tangal",[RekeningKoranController::class,'index2']);
route::get("/cetak/rekening_koran/urut_no_perkiraan",[RekeningKoranController::class,'index']);
route::get("/cetak/memorial_pemindah_bukuan",[MemorialPemindahBukuanController::class,'index']);
route::get("/cetak/memorial_pemindah_bukuan/view",[MemorialPemindahBukuanController::class,'indexview']);
route::get("/cetak/memorial_saldo_awal",[MemorialSaldoAwalController::class,'index']);
route::get("/cetak/memorial_saldo_awal/view",[MemorialSaldoAwalController::class,'indexview']);
route::get("/cetak/laporan_management",[LaporanManagementController::class,'index']);