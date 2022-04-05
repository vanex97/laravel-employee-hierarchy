<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeTreeController;
use App\Http\Controllers\PositionController;
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

Route::prefix('employees')->group(function() {
    Route::middleware('auth')->group(function() {
        Route::get('{head}/re-employment', [EmployeeController::class, 'reEmployment'])
            ->name('employees.reEmployment');

        Route::delete('{head}/re-employment', [EmployeeController::class, 'destroyAndReEmployment'])
            ->name('employees.reEmploymentStore');

        Route::post('autocomplete', [EmployeeController::class, 'autocomplete'])
            ->name('employees.autocomplete');

        Route::resource('', EmployeeController::class)
            ->parameter('', 'employee')
            ->names('employees');
    });
});

Route::prefix('positions')->group(function () {

    Route::middleware('auth')->group(function () {
        Route::post('autocomplete', [PositionController::class, 'autocomplete'])
            ->name('positions.autocomplete');

        Route::delete('{position}', [PositionController::class, 'destroy'])
            ->name('positions.destroy');

        Route::resource('', PositionController::class)
            ->except('destroy')
            ->parameter('', 'position')
            ->names('positions');
    });
});

Route::prefix('hierarchy')->group(function() {
    Route::get('', [EmployeeTreeController::class, 'index'])
        ->name('hierarchy.index');

    Route::get('{root}', [EmployeeTreeController::class, 'show'])
        ->name('hierarchy.show');

    Route::post('{root}', [EmployeeTreeController::class, 'getData'])
        ->name('hierarchy.data');
});

