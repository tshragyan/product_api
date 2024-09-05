<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/product', [ProductController::class, 'index'])->name('product.index');

Route::post('/product', [ProductController::class, 'create'])->name('product.create');
