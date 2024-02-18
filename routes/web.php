<?php

use App\Http\Controllers\Admin\MPositionController;
use App\Http\Controllers\Admin\UserRole;
use App\Http\Controllers\Admin\UsersController;
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


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => ['role:admin']], function () {
        //User Role
        Route::prefix('user-role')->group(function () {
            Route::get('/', [UserRole::class, 'index'])->name('index_user_role');
            Route::get('/create', [UserRole::class, 'create'])->name('create_user_role');
            Route::post('/store', [UserRole::class, 'store'])->name('store_user_role');
            Route::get('/edit/{id}', [UserRole::class, 'edit'])->name('edit_user_role');
            Route::put('/update/{id}', [UserRole::class, 'update'])->name('update_user_role');
            Route::get('/destroy/{id}', [UserRole::class, 'destroy'])->name('destroy_user_role');
        });

        //Users
        Route::prefix('users')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('index_users');
            Route::get('/create', [UsersController::class, 'create'])->name('create_users');
            Route::post('/store', [UsersController::class, 'store'])->name('store_users');
            Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('edit_users');
            Route::put('/update/{id}', [UsersController::class, 'update'])->name('update_users');
            Route::get('/destroy/{id}', [UsersController::class, 'destroy'])->name('destroy_users');
        });

        //position
        Route::prefix('position')->group(function () {
            Route::get('/', [MPositionController::class, 'index'])->name('index_position');
            Route::get('/create', [MPositionController::class, 'create'])->name('create_position');
            Route::post('/store', [MPositionController::class, 'store'])->name('store_position');
            Route::get('/edit/{id}', [MPositionController::class, 'edit'])->name('edit_position');
            Route::put('/update/{id}', [MPositionController::class, 'update'])->name('update_position');
            Route::get('/destroy/{id}', [MPositionController::class, 'destroy'])->name('destroy_position');
        });
    });
});
