<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->group(static function () {
    Route::get('/removeToken', [AuthController::class, 'removeToken']);
    Route::get('/employeeDetail', [EmployeeController::class, 'getAllEmployeeDetail']);
    Route::get('/personalBiodata', [EmployeeController::class, 'getAllPersonalBiodata']);
});
