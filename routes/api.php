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

    Route::match(['put', 'patch'], 'profile/{id}/edit', [UserController::class, 'update']);
    Route::delete('profile/{id}/delete', [UserController::class, 'deleteProfile']);

    Route::get('/employee/{id}', [EmployeeController::class, 'detail']);
    Route::post('/employeeDetail', [EmployeeController::class, 'addEmployeeDetail']);
    Route::match(['post', 'put'], '/employee/{id}/edit', [EmployeeController::class, 'updateEmployeeDetail']);
    Route::delete('/employee', [EmployeeController::class, 'delete']);

    Route::get('/biodata/{id}', [BiodataController::class, 'biodata']);
    Route::post('/personalBiodata', [BiodataController::class, 'addPersonalBiodata']);
    Route::match(['post', 'put'], '/biodata/{id}/edit', [BiodataController::class, 'updatePersonalBiodata']);
    Route::delete('/biodata', [BiodataController::class, 'delete']);

    Route::get('/getAllEmployee', [UserController::class, 'getAllData']);
    Route::get('/getAllDepartment', [EmployeeController::class, 'getDepartments']);

});
