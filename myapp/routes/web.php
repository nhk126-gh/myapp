<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ConnectController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/findall', [ProductController::class, 'findall']);

Route::post('/search', [ProductController::class, 'search']);

Route::get('/process', [ProductController::class, 'process']);
