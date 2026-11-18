<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LibroController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/libros');

Route::resource('libros', LibroController::class);
Route::resource('categorias', CategoriaController::class)
    ->only(['index', 'create', 'store', 'destroy']);
