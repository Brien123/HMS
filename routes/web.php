<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\Adminontroller::class, 'Dashboard'])->name('home');
//Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'Dashboard'])->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\AdminController::class, 'Dashboard'])->name('home');
//Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'Dashboard'])->name('dashboard');
