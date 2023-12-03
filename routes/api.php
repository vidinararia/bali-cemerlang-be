<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PackageController;
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
Route::get('about/view/{id}', [AboutController::class,'show']);
Route::put('about', [AboutController::class,'update']);

Route::post('offer', [OfferController::class,'store']);
Route::get('offer', [OfferController::class,'index']);
Route::get('offer/view/{id}', [OfferController::class,'show']);
Route::delete('offer', [OfferController::class,'destroy']);
Route::post('offer/update', [OfferController::class,'update']);

Route::get('package', [PackageController::class,'index']);
Route::get('package/view/{id}', [PackageController::class,'show']);
Route::post('package', [PackageController::class,'store']);
Route::delete('package', [PackageController::class,'destroy']);
Route::put('package', [PackageController::class,'update']);
Route::get('package/restore', [PackageController::class,'restore']);
