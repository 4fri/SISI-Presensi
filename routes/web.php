<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




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

Auth::routes();

Route::middleware('guest')->group(function () {
    Route::get('/', [WelcomeController::class, 'index']);
    Route::get('/cetak-berbintang', [WelcomeController::class, 'cetakPolaBintang'])->name('cetak-berbintang');
    Route::get('/cetak-angka', [WelcomeController::class, 'cetakPolaAngka'])->name('cetak-angka');
});


Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
