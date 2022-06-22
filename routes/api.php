<?php

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\CompanyApiController;
use App\Http\Controllers\EmployeeApiController;
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

Route::post('/login', [AuthApiController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', [AuthApiController::class, 'user']);
    Route::apiResources(
        [
            'companies' => CompanyApiController::class,
            'employees' => EmployeeApiController::class
        ]
    );
});
