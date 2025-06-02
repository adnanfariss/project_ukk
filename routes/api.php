<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APIGuruController;
use App\Http\Controllers\API\APIUserController;
use App\Http\Controllers\API\APISiswaController;
use App\Http\Controllers\API\APIIndustriController;
use App\Http\Controllers\API\APIPklController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('guru', APIGuruController::class);
Route::apiResource('user', APIUserController::class);
Route::apiResource('siswa', APISiswaController::class);
Route::apiResource('industri', APIIndustriController::class);
Route::apiResource('pkl', APIPklController::class);