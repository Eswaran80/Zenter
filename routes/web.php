<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login-page');
});

Route::get('login',[LoginController::class,'loginshow'])->name('login.show');

Route::get('register',[LoginController::class,'registershow'])->name('register.show');







