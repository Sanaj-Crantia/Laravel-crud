<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('post',PostController::class);
    
});



Route::controller(UserController::class)->group(function () {
    Route::get('/user/register', 'showRegister')->name('showRegister');
    Route::post('/user/register', 'register')->name('register');
    Route::get('/user/login', 'showLogin')->name('showLogin');
    Route::Post('/user/login', 'login')->name('login');
    Route::get('/user/change', 'showChangePassword')->name('showChangePassword');
    Route::patch('/user/change', 'changePassword')->name('changePassword');
    Route::get('/user/logout', 'logout')->name('logout');
});