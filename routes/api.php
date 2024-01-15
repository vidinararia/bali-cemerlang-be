<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PromoController;
use App\Http\Middleware\Authenticate;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});

Route::controller(AboutController::class)->prefix('about')->group(function () {
    Route::get('', 'index');
    Route::get('view/{id}', 'show')->middleware([Authenticate::class]);
    Route::put('', 'update')->middleware([Authenticate::class]);
});

Route::controller(OfferController::class)->prefix('offer')->group(function () {
    Route::get('', 'index');
    Route::post('', 'store')->middleware([Authenticate::class]);
    Route::get('view/{id}', 'show')->middleware([Authenticate::class]);
    Route::delete('{id}', 'destroy')->middleware([Authenticate::class]);
    Route::post('update', 'update')->middleware([Authenticate::class]);
});

Route::controller(GalleryController::class)->prefix('gallery')->group(function () {
    Route::get('', 'index');
    Route::post('', 'store')->middleware([Authenticate::class]);
    Route::get('view/{id}', 'show')->middleware([Authenticate::class]);
    Route::delete('{id}', 'destroy')->middleware([Authenticate::class]);
});

Route::controller(PromoController::class)->prefix('promo')->group(function () {
    Route::get('', 'index');
    Route::post('', 'store')->middleware([Authenticate::class]);
    Route::get('view/{id}', 'show')->middleware([Authenticate::class]);
    Route::delete('{id}', 'destroy')->middleware([Authenticate::class]);
    Route::post('update', 'update')->middleware([Authenticate::class]);
});

Route::controller(NewsController::class)->prefix('news')->group(function () {
    Route::get('', 'index');
    Route::post('', 'store')->middleware([Authenticate::class]);
    Route::get('view/{id}', 'show')->middleware([Authenticate::class]);
    Route::delete('{id}', 'destroy')->middleware([Authenticate::class]);
    Route::post('update', 'update')->middleware([Authenticate::class]);
});

Route::controller(PackageController::class)->prefix('package')->group(function () {
    Route::get('', 'index');
    Route::get('view/{id}', 'show')->middleware([Authenticate::class]);
    Route::post('', 'store')->middleware([Authenticate::class]);
    Route::delete('{id}', 'destroy')->middleware([Authenticate::class]);
    Route::put('', 'update')->middleware([Authenticate::class]);
    Route::get('restore/{id}', 'restore')->middleware([Authenticate::class]);
});
