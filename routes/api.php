<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->group(function (){
    Route::post('login', [AuthenticationController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function (){
        Route::post('logout', [AuthenticationController::class, 'logout']);
    });

});


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('employees')->group(function (){
        Route::get('/', [EmployeeController::class, 'index']);
        Route::get('/{employee}', [EmployeeController::class, 'show']);
    });
});
