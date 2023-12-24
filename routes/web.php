<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::redirect('/dashboard', '/');

    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');

        Route::get('/add', [ProductController::class, 'add'])->name('product.add');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');

        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/update/{product}', [ProductController::class, 'update'])->name('product.update');

        Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

        Route::prefix('image')->group(function () {
            Route::post('/store', [ProductImageController::class, 'store'])->name('product.image.store');
            Route::delete('/destroy/{image}', [ProductImageController::class, 'destroy'])->name('product.image.destroy');
        });
    });
});

Route::middleware(['auth' => 'is_admin'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
    });
});

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/authenticate', [UserController::class, 'authenticate'])->name('authenticate');
Route::get('/register-form', [UserController::class, 'register'])->name('register-form');
Route::post('/register', [UserController::class, 'create'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
