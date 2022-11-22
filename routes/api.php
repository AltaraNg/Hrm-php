<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
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
Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);
    Route::patch('assign/permission/to/role/{role}', [RolePermissionController::class, 'assignPermissionsToRole'])
});
