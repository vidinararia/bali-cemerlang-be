<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\TiketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('about', [AboutController::class,'index']);
Route::put('about', [AboutController::class,'update']);
// Route::get('tiket-pesawat', [TiketController::class,'index']);
