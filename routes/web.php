<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserRole;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\OffWorkController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\MPositionController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\TravelPermitController;
use App\Http\Controllers\Employee\DTEmployeeController;
use App\Http\Controllers\Employee\DTAttendanceController;





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


        Route::prefix('employees')->group(function () {
            Route::get('/', [EmployeesController::class, 'index'])->name('index_employees');
            Route::get('/create', [EmployeesController::class, 'create'])->name('create_employees');
            Route::post('/store', [EmployeesController::class, 'store'])->name('store_employees');
            // Route::put('/update/{id}', [EmployeesController::class, 'update'])->name('update_employees');
        });

        Route::prefix('attendances')->group(function () {
            Route::get('/', [AttendanceController::class, 'index'])->name('index_attendances');
            Route::get('/show-detail/{id}', [AttendanceController::class, 'showDetail'])->name('show_detail_attendances');
        });
    });

    Route::get('/show-detail/payroll/{id}', [AttendanceController::class, 'payrollAttendance'])
        ->name('payroll_attendances');
    Route::post('/show-detail/payroll/store/{id}', [AttendanceController::class, 'storePayrollAttendance'])
        ->name('store_payroll_attendances');

    Route::prefix('off-work')->group(function () {
        Route::get('/', [OffWorkController::class, 'index'])->name('index_off_work');
        Route::get('/create', [OffWorkController::class, 'create'])->name('create_off_work')->middleware('role:employee');
        Route::post('/store', [OffWorkController::class, 'store'])->name('store_off_work')->middleware('role:employee');
        Route::put('/update/{id}', [OffWorkController::class, 'update'])->name('update_off_work')->middleware('role:admin');
    });

    Route::prefix('travel-permit')->group(function () {
        Route::get('/', [TravelPermitController::class, 'index'])->name('index_travel_permit');
        Route::get('/create', [TravelPermitController::class, 'create'])->name('create_travel_permit')->middleware('role:employee');
        Route::post('/store', [TravelPermitController::class, 'store'])->name('store_travel_permit')->middleware('role:employee');
        Route::put('/update/{id}', [TravelPermitController::class, 'update'])->name('update_travel_permit')->middleware('role:admin');
    });

    Route::group(['middleware' => ['role:employee']], function () {
        Route::prefix('profile')->group(function () {
            Route::get('/', [DTEmployeeController::class, 'show'])->name('profile_employee');
            Route::get('/profile/edit', [DTEmployeeController::class, 'edit'])->name('edit_profile_employee');
            Route::put('/profile/update', [DTEmployeeController::class, 'update'])->name('update_profile_employee');
        });

        Route::prefix('attendance')->group(function () {
            Route::get('/', [DTAttendanceController::class, 'attendance'])->name('attendance');
            Route::post('/check-in', [DTAttendanceController::class, 'checkIn'])->name('check_in');
        });
    });
});
