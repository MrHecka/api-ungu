<?php

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
Route::controller(AuthController::class)->group(function() {
    Route::get('/auth','index')->middleware('isGuest');
    Route::post('/auth/login','loginGan')->middleware('isGuest');
    Route::get('/auth/register','register')->middleware('isGuest');
    Route::post('/auth/registme','createUser')->middleware('isGuest');
    Route::get('/auth/logout','logout');
});

// PAGE CONTROLLER
Route::controller(pageController::class)->group(function() {
    Route::get('/dashboard', 'dashboard')->middleware('isUser');
});
