<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
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

Route::get('/admin/hotels', [AdminController::class, 'listHotels']);
Route::post('/admin/actualizar-precios', [AdminController::class, 'updatePrices'])->name('admin.actualizar_precios');
Route::get('/admin/ver-comisiones', [AdminController::class, 'calculateCommissions'])->name('admin.ver_comisiones');

Route::get('/usuario/datos', [UserController::class, 'getUserData'])->name('user.datos');
Route::post('/usuario/update', [UserController::class, 'updateUserData'])->name('user.update');

Route::post('/reserva/crear', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/admin/cancelar-reserva/{id}', [UserController::class, 'cancelReservation'])->name('cancelar.reserva');
Route::post('/admin/buscar-reservas', [UserController::class, 'searchReservations'])->name('admin.buscar.reservas');
Route::get('/conductor', [ConductorController::class, 'index'])->name('conductor.index');
Route::post('/conductor', [ConductorController::class, 'calendario'])->name('conductor.calendario');
