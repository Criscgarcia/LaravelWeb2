<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CarroController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('carros', CarroController::class);