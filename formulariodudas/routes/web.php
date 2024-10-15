<?php

<<<<<<< HEAD

=======
use Illuminate\Support\Facades\Route;
>>>>>>> a9ead9542c74bed984dca57bf5b387b8f1f167ff
use App\Http\Controllers\DudasController;

Route::get('/', [DudasController::class, 'mostrarFormulario']);

Route::post('/guardar_dudas', [DudasController::class, 'guardarDuda'])->name('guardar.duda');