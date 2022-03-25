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

        Route::resource('', PositionController::class)
            ->parameter('', 'position')
            ->names('positions');
    });

});

