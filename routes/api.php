<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JabatanController;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\SKPDController;
use App\Http\Controllers\Api\UnitKerjaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/jabatan', JabatanController::class);
    Route::apiResource('/asn', PegawaiController::class);
    Route::apiResource('/skpd', SKPDController::class);
    Route::apiResource('/unitkerja', UnitKerjaController::class);
});
