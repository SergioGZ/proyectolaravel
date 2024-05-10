<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\EntradaController;
use App\Models\Usuario;

Route::get('/', [EntradaController::class, 'index'])->middleware('auth')->name('home');

// Ruta para mostrar el formulario de registro
Route::get('/register', [UsuarioController::class, 'create'])->name('register');

// Ruta para procesar el registro
Route::post('/register', [UsuarioController::class, 'store'])->name('store');

// Ruta para mostrar el formulario de inicio de sesión
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Ruta para procesar el inicio de sesión
Route::post('/login', [LoginController::class, 'login']);

// Ruta para cerrar sesión
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::resource('/usuarios', UsuarioController::class)->middleware('auth');

Route::resource('/entradas', EntradaController::class)->middleware('auth');
