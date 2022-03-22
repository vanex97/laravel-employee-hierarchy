<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::redirect('/', '/employees');

Route::get('employees/autocomplete', [EmployeeController::class, 'autocomplete'])
    ->name('employees.autocomplete')
    ->middleware('auth');

Route::resource('employees', EmployeeController::class)
    ->middleware('auth');

Route::post('positions/autocomplete', [PositionController::class, 'autocomplete'])
    ->name('positions.autocomplete')
    ->middleware('auth');
