<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::post('user/login' , [LoginController::class, 'login']);
Route::get('user/logout' , [LoginController::class, 'logout']);


Route::get('register', [RegisterController::class, 'register']);
Route::post('users/register', [RegisterController::class, 'store']);


Route::prefix('user')->group(function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('list' , 'index');
        Route::get('create' , 'create');
        Route::post('store' , 'store');
        Route::get('edit/{id}' , 'edit');
        Route::post('update/{id}' , 'update');
        Route::get('delete/{id}' , 'destroy');
    });
});
