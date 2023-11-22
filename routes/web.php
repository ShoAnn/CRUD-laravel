<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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
    Route::get('/', function () {
        return view('pages.static.home');
    })->name('dashboard');
    Route::redirect('/dashboard', '/');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');

    Route::get('/product/add', [ProductController::class, 'add'])->name('product.add');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');

    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');

    Route::delete('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/authenticate', [UserController::class, 'authenticate'])->name('authenticate');
Route::get('/register-form', [UserController::class, 'register'])->name('register-form');
Route::post('/register', [UserController::class, 'create'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
