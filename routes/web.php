<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::get('/profile', [HomeController::class, 'profile'])->name('profiles');
Route::get('/profile/edit/{id}', [HomeController::class, 'editProfile'])->name('profiles.edit');

Route::get('/detail', [HomeController::class, 'detail'])->name('details');
Route::get('/detail/create', [HomeController::class, 'addDetail'])->name('details.add');
Route::get('/detail/edit/{id}', [HomeController::class, 'editDetail'])->name('details.edit');

Route::get('/biodata', [HomeController::class, 'detailBio'])->name('biodatas');
Route::get('/biodata/create', [HomeController::class, 'addBio'])->name('biodatas.add');
Route::get('/biodata/edit/{id}', [HomeController::class, 'editBio'])->name('biodatas.edit');


Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->middleware('admin.only')->name('dashboard');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'login'])->name('welcome');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [HomeController::class, 'login']);
Route::get('/register', [HomeController::class, 'register']);
Route::get('/redirectWith', [HomeController::class, 'redirectWith']);
