<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/issueToken', [AuthController::class, 'issueToken']);

Route::middleware('auth:sanctum')->group(static function () {
    Route::get('/removeToken', [AuthController::class, 'removeToken']);
    Route::get('/employeeDetail', [EmployeeController::class, 'getAllEmployeeDetail']);
    Route::get('/personalBiodata', [EmployeeController::class, 'getAllPersonalBiodata']);

    Route::get('/employeeDetail', [EmployeeController::class, 'detail']);
    Route::get('/employeeDetail/{id}', [EmployeeController::class, 'detail']);
    Route::post('/employeeDetail', [EmployeeController::class, 'addEmployee']);
    Route::match(['post', 'put'], '/employeeDetail/{id}', [EmployeeController::class, 'updateEmployee']);
    Route::delete('/employeeDetail', [EmployeeController::class, 'delete']);

    Route::get('/personalBio', [EmployeeController::class, 'detail']);
    Route::get('/personalBio/{id}', [EmployeeController::class, 'detail']);
    Route::post('/personalBio', [EmployeeController::class, 'addBio']);
    Route::match(['post', 'put'], '/personalBio/{id}', [EmployeeController::class, 'updateBio']);
    Route::delete('/personalBio', [EmployeeController::class, 'delete']);

    Route::get('/getAllEmployee', [HomeController::class, 'employees']);

});
