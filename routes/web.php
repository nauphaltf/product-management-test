<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AttributeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/products', [ProductController::class, 'index'])->name('product.list');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::post('/product/image-upload', [ProductController::class, 'uploadImage'])->name('product.image-upload');
Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('/attributes', [AttributeController::class, 'index'])->name('attribute.list');
Route::post('/attributes/store', [AttributeController::class, 'store'])->name('attribute.store');
Route::get('/attributes/delete/{id}', [AttributeController::class, 'delete'])->name('attribute.delete');
