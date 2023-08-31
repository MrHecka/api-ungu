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
Route::get('carimahasiswa',[ApiMhsController::class, 'index'])->name('carimahasiswa.index');
Route::get('carimahasiswa/{mhs}',[ApiMhsController::class, 'show'])->name('carimahasiswa.show');

// API CEKRESI
Route::get('cekresi', [CekResiController::class, 'index'])->name('cekresi.index');
Route::get('cekresi/{service}', [CekResiController::class, 'show'])->name('cekresi.show');

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
