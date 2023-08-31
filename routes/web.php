<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\pageController;

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
    return redirect('/auth');
});

// AUTH ROUTER CONTROLLER
Route::controller(AuthController::class)->group(function () {
    Route::get('/auth', 'index')->middleware('isGuest')->name('login');
    Route::post('/auth/login', 'loginGan')->middleware('isGuest')->name('postlogin');
    Route::get('/auth/register', 'register')->middleware('isGuest')->name('register');
    Route::post('/auth/registme', 'createUser')->middleware('isGuest')->name('postregister');
    Route::get('/auth/logout', 'logout')->name('logout');
});

// PAGE CONTROLLER
Route::controller(pageController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->middleware('isUser')->name('dashboard');
    Route::get('/docs', 'docs')->middleware('isUser')->name('docs');
    Route::get('/about', 'about')->middleware('isUser')->name('about');
    Route::get('/profil', 'profil')->middleware('isUser')->name('profil');
    Route::post('/profil/update', 'update')->middleware('isUser')->name('profil.update');
    Route::get('/profil/gantiPassword', 'gantiPassword')->middleware('isUser')->name('profil.gantiPassword');
    Route::post('/profil/updatePassword', 'store')->middleware('isUser')->name('profil.updatePassword');
});

// ADMIN CONTROLLER
Route::middleware(['isUser', 'isDewa'])->group(function () {
    Route::resource('/admin', AdminController::class);
});

