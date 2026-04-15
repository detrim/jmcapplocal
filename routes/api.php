<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\PegawaiController;


Route::get('/wilayah/searchkabupaten', [PegawaiController::class, 'searchKabupaten']);
Route::middleware(['auth:sanctum', 'active'])->group(function () {
    Route::get('/wilayah/searchwilayah', [PegawaiController::class, 'searchLocal']);
    Route::get('/pegawaisearch', [PegawaiController::class, 'search']);
    Route::get('/checkusername', [PegawaiController::class, 'checkusername']);
    });


