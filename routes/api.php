<?php

use App\Http\Controllers\API\AlquranAyatController;
use App\Http\Controllers\API\AlquranSurahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiMhsController;
use App\Http\Controllers\API\bmkgController;
use App\Http\Controllers\API\cariAnimeController;
use App\Http\Controllers\API\CekResiController;
use App\Http\Controllers\API\freeEGController;
use App\Http\Controllers\API\TiktokDownloaderController;
use App\Http\Controllers\API\cariFilmController;
use App\Http\Controllers\API\CekResi2Controller;
use App\Http\Controllers\API\gunungberapiController;
use App\Http\Controllers\API\jadwalSholatController;
use App\Http\Controllers\API\streamingAnimeController;
use App\Http\Controllers\API\wikipediaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API MAHASISWA
Route::get('carimahasiswa', [ApiMhsController::class, 'index'])->name('carimahasiswa.index');
Route::get('carimahasiswa/{mhs}', [ApiMhsController::class, 'show'])->name('carimahasiswa.show');

// API CEKRESI V1
Route::get('v1/cekresi', [CekResiController::class, 'index'])->name('cekresi.index');
Route::get('v1/cekresi/{service}', [CekResiController::class, 'show'])->name('cekresi.show');

// API CEKRESI V2
Route::get('v2/cekresi', [CekResi2Controller::class, 'index'])->name('cekresi2.index');
Route::get('v2/cekresi/{service}', [CekResi2Controller::class, 'show'])->name('cekresi2.show');


// API ALQURAN
Route::get('alquran/surah', [AlquranSurahController::class, 'index'])->name('alquransurah.index');
Route::get('alquran/surah/{id}', [AlquranSurahController::class, 'show'])->name('alquransurah.show');
Route::get('alquran/ayat', [AlquranAyatController::class, 'index'])->name('alquranayat.index');
Route::get('alquran/ayat/{id}', [AlquranAyatController::class, 'show'])->name('alquranayat.show');

// API TIKTOK DOWNLOADER
Route::get('tiktok', [TiktokDownloaderController::class, 'index'])->name('tiktokdownloader.index');
Route::get('tiktok/', [TiktokDownloaderController::class, 'show'])->name('tiktokdownloader.show');

// BMKG API
Route::get('bmkg/gempaterbaru', [bmkgController::class, 'index'])->name('bmkggempa.index');

// FREE GAMES API
Route::get('freegames/epicgames', [freeEGController::class, 'index'])->name('freeepicgames.index');

// CARI FILM
Route::get('/film/cari', [cariFilmController::class, 'index'])->name('carifilm.index');
Route::get('/film/cari/', [cariFilmController::class, 'show'])->name('carifilm.show');

// CARI ANIME
Route::get('/anime/carianime', [cariAnimeController::class, 'index'])->name('carianime.index');
Route::post('/anime/carianime', [cariAnimeController::class, 'store'])->name('carianime.store');
Route::get('/anime/carianime/', [cariAnimeController::class, 'show'])->name('carianime.show');

// WIKIPEDIA TAHUKAH ANDA?
Route::get('/wikipedia/tahukahanda', [wikipediaController::class, 'index'])->name('tahukahanda.index');

// STREAMING ANIME API
Route::get('/anime/streaminganime', [streamingAnimeController::class, 'index'])->name('streaminganime.index');
Route::get('/anime/streaminganime/', [streamingAnimeController::class, 'show'])->name('streaminganime.show');

// JADWAL SHOLAT API
Route::get('/jadwalsholat', [jadwalSholatController::class, 'index'])->name('jadwalsholat.index');
Route::get('/jadwalsholat/{idkota}/{tahun}/{bulan}/{hari}', [jadwalSholatController::class, 'show'])->name('jadwalsholat.show');

// GUNUNG BERAPI 
Route::get('/gunungberapi', [gunungberapiController::class, 'index'])->name('gunungberapi.index');
