<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/login', [HomeController::class, 'login']);
Route::get('/register', [HomeController::class, 'register']);

Route::get('/profile', [HomeController::class, 'profile']);
Route::get('/profile/edit/{id}', [HomeController::class, 'edit'])->name('profiles.edit');
Route::get('profile/update/{id}', [HomeController::class, 'update'])->name('profiles.update');


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
