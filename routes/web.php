<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page');
});

Route::get('login',[LoginController::class,'loginshow'])->name('login.show');

Route::get('register',[LoginController::class,'registershow'])->name('register.show');

Route::get('dashboard',[LoginController::class,'dashboardshow'])->name('dashboard.show');

Route::post('login-store',[LoginController::class,'loginstore'])->name('login.store');

Route::post('loginCheck',[LoginController::class,'logincheck'])->name('login.check');

Route::get('users',[LoginController::class,'usershow'])->name('users.page');



Route::get('add_user_form', function () {
    return view('user_add_form');
});






