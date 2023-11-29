<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;

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

Route::prefix('product-api')->group(function () {
    Route::get('/', [ProductController::class, 'index_resource'])->name('product.index');
    Route::post('/store', [ProductController::class, 'store_resource'])->name('product.store');
    Route::post('/update/{product}', [ProductController::class, 'update_resource'])->name('product.update');
    Route::post('/destroy/{product}', [ProductController::class, 'destroy_resource'])->name('product.destroy');

    Route::prefix('image')->group(function () {
        Route::post('/store', [ProductImageController::class, 'store_resource'])->name('product.image.store');
        Route::delete('/destroy/{image}', [ProductImageController::class, 'destroy_resource'])->name('product.image.destroy');
    });
});
