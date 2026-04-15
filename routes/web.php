<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelolaUserController;
use App\Http\Controllers\DataPegawaiController;



Route::middleware(['auth'])->group(function () {
    Route::get('/user', [KelolaUserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}/edit', [KelolaUserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}/update', [KelolaUserController::class, 'update'])->name('user.update');
    Route::get('/user/{id}/detail', [KelolaUserController::class, 'detail'])->name('user.detail');

        Route::prefix('superadmin')->group(function () {
            Route::get('/', [DashboardController::class, 'index']);
            Route::get('/user/create', [KelolaUserController::class, 'create'])->name('user.create');
            Route::post('/user/store', [KelolaUserController::class, 'store'])->name('user.store');
            Route::delete('/user/{id}/delete', [KelolaUserController::class, 'delete'])->name('user.destroy');
            });
        Route::prefix('adminhrd')->group(function () {
            Route::get('/', [DashboardController::class, 'index']);
            Route::get('/pegawai', [DataPegawaiController::class, 'index'])->name('pegawai.index');
            Route::get('/pegawai/search', [DataPegawaiController::class, 'cari'])->name('pegawai.cari');
            Route::get('/pegawai/create', [DataPegawaiController::class, 'create'])->name('pegawai.create');
            Route::post('/pegawai/store', [DataPegawaiController::class, 'store'])->name('pegawai.store');
            Route::get('/pegawai/{id}/detail', [DataPegawaiController::class, 'detail'])->name('pegawai.detail');
            Route::get('/pegawai/{id}/edit', [DataPegawaiController::class, 'edit'])->name('pegawai.edit');
            Route::put('/pegawai/{id}/update', [DataPegawaiController::class, 'update'])->name('pegawai.update');
            Route::delete('/pegawai/delete', [DataPegawaiController::class, 'delete'])->name('pegawai.destroy');
            Route::get('/pegawai/{id}/pdf', [DataPegawaiController::class, 'downloadPdf'])->name('pegawai.pdf');
            Route::get('/pegawai/exportpdf', [DataPegawaiController::class, 'exportPdf'])->name('pegawai.export.pdf');
            Route::get('/pegawai/exportexcel', [DataPegawaiController::class, 'exportExcel'])->name('pegawai.export.excel');
            Route::get('/pegawai/filter', [DataPegawaiController::class, 'filter'])->name('pegawai.filter');
            Route::post('/pegawai/bulkstatus', [DataPegawaiController::class, 'bulkStatus']);

    });
        Route::prefix('managerhrd')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::get('/',[AuthController::class,'login'])->name('login');
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/postlog',[AuthController::class,'postlogin']);
