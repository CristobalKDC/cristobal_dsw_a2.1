<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DudasController;

Route::get('/', [DudasController::class, 'mostrarFormulario']);

Route::post('/guardar_dudas', [DudasController::class, 'guardarDuda'])->name('guardar.duda');