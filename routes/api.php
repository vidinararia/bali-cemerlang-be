<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PackageController;
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


Route::controller(AboutController::class)->prefix('about')->group(function () {
    Route::get('', 'index');
    Route::get('view/{id}', 'show');
    Route::put('', 'update');
});

Route::controller(OfferController::class)->prefix('offer')->group(function () {
    Route::post('', 'store');
    Route::get('', 'index');
    Route::get('view/{id}', 'show');
    Route::delete('', 'destroy');
    Route::post('update', 'update');
    Route::get('restore', 'restore');
});

Route::controller(PackageController::class)->prefix('package')->group(function () {
    Route::get('', 'index');
    Route::get('view/{id}', 'show');
    Route::post('', 'store');
    Route::delete('', 'destroy');
    Route::put('', 'update');
    Route::get('restore', 'restore');
});
