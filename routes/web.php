<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('locale', [LocaleController::class, 'change'])->name('locale');
Route::get('test', [Controller::class, 'test']);
Auth::routes(['register' => false]);
Route::group(['middleware' => 'auth'], function () {
    Route::resources(
        [
            'companies' => CompanyController::class,
            'employees' => EmployeeController::class
        ],
        ['except'=>['show']]
    );
});
