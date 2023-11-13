<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\KantorController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PresensiController;
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

// Posisi user tidak login
Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});

// Posisi user login
Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);

    // Presensi Absen
    Route::get('/presensi/create', [PresensiController::class, 'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    // Edit Profile
    Route::get('/editprofile', [PresensiController::class, 'editprofile']);
    Route::post('/presensi/{nik}/updateprofile', [PresensiController::class, 'updateprofile']);

    // Histori
    Route::get('/presensi/histori', [PresensiController::class, 'histori']);
    Route::post('/gethistori', [PresensiController::class, 'gethistori']);

    // Izin/Sakit
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/izinadd', [PresensiController::class, 'izinadd']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin']);
});


Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
});

Route::middleware(['auth:user'])->group(function () {
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);
    Route::get('/panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);

    // Karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::post('/karyawan/store', [KaryawanController::class, 'store']);
    Route::post('/karyawan/edit', [KaryawanController::class, 'edit']);
    Route::post('/karyawan/{nik}/update', [KaryawanController::class, 'update']);
    Route::delete('/karyawan/delete/{nik}', [KaryawanController::class, 'delete']);

    // Department
    Route::get('/department', [DepartmentController::class, 'index']);
    Route::post('/department/store', [DepartmentController::class, 'store']);
    Route::post('/department/edit', [DepartmentController::class, 'edit']);
    Route::post('/department/{kode_dept}/update', [DepartmentController::class, 'update']);
    Route::delete('/department/destroy/{kode_dept}', [DepartmentController::class, 'destroy']);

    // Kantor 
    Route::get('/kantor', [KantorController::class, 'index']);
    Route::get('/kantor/create', [KantorController::class, 'create']);
    Route::post('/kantor/store', [KantorController::class, 'store']);
    Route::get('/kantor/edit/{id}', [KantorController::class, 'edit']);
    Route::post('/kantor/update/{id}', [KantorController::class, 'update']);
    Route::delete('/kantor/destroy/{id}', [KantorController::class, 'destroy']);

    // Pengajuan (Sakit & Izin)
    //? Sakit  
    Route::get('/pengajuan/sakit', [PengajuanController::class, 's_index']);
    Route::post('/pengajuan/sakit/edit', [PengajuanController::class, 's_edit']);
    Route::post('/pengajuan/sakit/update/{id}', [PengajuanController::class, 's_update']);
    Route::delete('/pengajuan/sakit/destroy/{id}', [PengajuanController::class, 's_destroy']);
});
