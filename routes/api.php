<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APIPklController;
use App\Http\Controllers\API\APIGuruController;
use App\Http\Controllers\API\APIUserController;
use App\Http\Controllers\API\APISiswaController;
use App\Http\Controllers\API\APIIndustriController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('guru', APIGuruController::class);
    Route::apiResource('user', APIUserController::class);
    Route::apiResource('siswa', APISiswaController::class);
    Route::apiResource('industri', APIIndustriController::class);
    Route::apiResource('pkl', APIPklController::class);
});

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $user = User::where('email', $request->email)->first();

    // Ensure the response is JSON and not redirected
    return response()->json([
        'token' => $user->createToken('api-token')->plainTextToken,
    ], 200);
});