<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\AccesorioController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacturaCompraController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\OrdenServicioController;

Auth::routes(['reset' => true, 'verify' => true]);


Route::resource('ordenes', OrdenServicioController::class)->middleware('auth');

// Rutas para la búsqueda de accesorios
Route::get('/accesorios/search', [AccesorioController::class, 'search'])->name('accesorios.search');
Route::get('/accesorios/autocomplete', [AccesorioController::class, 'autocomplete'])->name('accesorios.autocomplete');

// Rutas para los proveedores
Route::resource('proveedores', ProveedorController::class)->middleware('auth');

// Rutas para las facturas de compra (con autenticación)
Route::middleware(['auth'])->group(function () {
    Route::resource('facturas', FacturaCompraController::class);
});

// Rutas para el dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Rutas para los clientes (con búsqueda)
Route::get('/clientes/search', [ClienteController::class, 'search'])->name('clientes.search')->middleware('auth');
Route::resource('clientes', ClienteController::class)->middleware('auth');

// Rutas para los accesorios
Route::resource('accesorios', AccesorioController::class)->middleware('auth');

// Rutas para las categorías
Route::resource('categorias', CategoriaController::class)->middleware('auth');

// Rutas para el registro de usuarios (solo admin)
Route::middleware(['auth', 'can:isAdmin'])->group(function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Rutas para las ventas
Route::middleware(['auth'])->group(function () {
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
    Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
});

// Ruta para la página de inicio (cualquier usuario)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Autenticación de usuarios
Auth::routes();
