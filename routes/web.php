<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use Illuminate\Http\Request;

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

Route::get('/particular', function (Request $request) {
    $section = $request->query('section', 'default');
    session(['section' => $section]);  // Establece la sección en la sesión
    $email = session('user_email');
    $reservations = app('App\Http\Controllers\UserController')->getUserReservations($email);
    return view('particular', compact('section', 'reservations'));
})->name('particular');

Route::get('/admin', function (Request $request) {
    $section = $request->query('section', 'default');
    session(['section' => $section]);
    return view('admin', compact('section'));
})->name('admin');

Route::get('/usuario/datos', [UserController::class, 'getUserData'])->name('user.datos');
Route::post('/usuario/update', [UserController::class, 'updateUserData'])->name('user.update');

Route::post('/reserva/crear', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/particular/reservas', [UserController::class, 'viewReservations'])->name('particular.reservas');
Route::post('/reservas/cancelar/{id}', [UserController::class, 'cancelReservation'])->name('reservas.cancelar');
