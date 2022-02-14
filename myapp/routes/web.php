<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/findall', [ProductController::class, 'findall']);

Route::post('/search', [ProductController::class, 'search']);

Route::post('/process', [ProductController::class, 'process']);
