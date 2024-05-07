<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'loginUser'])->name('login.post');

Route::get('/registro', function () {
    return view('registro');
})->name('registro');

Route::post('/registro', [AuthController::class, 'registerUser'])->name('registro.post');

