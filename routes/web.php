<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProcedureTypeController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () { return view('painel.admin'); })->name('painel.admin');
    Route::resource('barbers', BarberController::class);
    Route::resource('reports', ReportController::class);
});

Route::middleware(['auth', 'barbeiro'])->prefix('barbeiro')->as('barbeiro.')->group(function () {
    Route::get('/', function () { return view('painel.barbeiro'); })->name('painel.barbeiro');
    Route::resource('clients', ClientController::class)->parameters(['clients' => 'user']);
    Route::resource('procedures', ProcedureController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('procedure-types', ProcedureTypeController::class);
});

Route::middleware(['auth', 'cliente'])->prefix('cliente')->as('cliente.')->group(function () {
    Route::get('/', function () { return view('painel.cliente'); })->name('painel.cliente');
    Route::resource('procedures', ProcedureController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
});

Auth::routes();
