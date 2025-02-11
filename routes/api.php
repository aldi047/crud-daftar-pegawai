<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/issueToken', [AuthController::class, 'issueToken']);

Route::middleware('auth:sanctum')->group(static function () {
    Route::get('/removeToken', [AuthController::class, 'removeToken']);

    Route::get('/files', [HomeController::class, 'getFile'])->name('getFile');

    Route::match(['put', 'patch'], 'profile/edit/{id}', [UserController::class, 'update']);

    Route::get('/employees', [EmployeeController::class, 'getAllEmployees']);
    Route::get('/employee/{id}', [EmployeeController::class, 'detail']);
    Route::post('/employee', [EmployeeController::class, 'addEmployee']);
    Route::match(['post', 'put'], '/employee/{id}', [EmployeeController::class, 'updateEmployee']);
    Route::delete('/employee', [EmployeeController::class, 'delete']);

    Route::get('/personalBio', [EmployeeController::class, 'detail']);
    Route::get('/personalBio/{id}', [EmployeeController::class, 'detail']);
    Route::post('/personalBio', [EmployeeController::class, 'addBio']);
    Route::match(['post', 'put'], '/personalBio/{id}', [EmployeeController::class, 'updateBio']);
    Route::delete('/personalBio', [EmployeeController::class, 'delete']);

    Route::get('/getAllEmployee', [HomeController::class, 'employees']);

});
