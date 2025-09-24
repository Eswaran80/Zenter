<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewsController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware('guest',AuthMiddleware::class)->group(function(){
    Route::get('/', function () {
    return view('landing-page');
});
    Route::get('login',[LoginController::class,'loginshow'])->name('login');
    Route::get('register',[LoginController::class,'registershow'])->name('register.show');
    Route::post('login-store',[LoginController::class,'loginstore'])->name('login.store');
    Route::post('loginCheck',[LoginController::class,'logincheck'])->name('login.check');
});

Route::middleware('auth',AuthMiddleware::class)->group(function(){
    Route::get('dashboard',[LoginController::class,'dashboardshow'])->name('dashboard.show');

    Route::get('users',[LoginController::class,'usershow'])->name('users.page');

    Route::post('store',[UserController::class,'store'])->name('user.store');

    Route::get('add_user_form', function () {
    return view('user_add_form');
});
Route::post('logout',[LoginController::class,'logout'])->name('logout');

});

Route::middleware('auth',AuthMiddleware::class)->controller(ViewsController::class)->group(function(){
    Route::get('tasks','tasksshow')->name('task-page-show');
    Route::get('Team','teamshow')->name('team-page-show');
    Route::get('Reports','reportsshow')->name('reports-page-show');
    Route::get('Notifications','notificationsshow')->name('notifications-page-show');
    Route::get('Calendar','calendarshow')->name('calendar-page-show');
    Route::get('Projects','projectsshow')->name('projects-page-show');
    Route::get('Messages','messagesshow')->name('messages-page-show');
    Route::get('Account','accountshow')->name('account-page-show');
    Route::get('Support','supportshow')->name('support-page-show');
    Route::get('Settings','settingsshow')->name('settings-page-show');
    Route::post('user-store','storeUser')->name('user.store');
});


Route::get('test',function(){
    return view('Test_page');

});











