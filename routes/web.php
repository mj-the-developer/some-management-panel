<?php

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

Route::redirect('/', 'login');

Route::middleware('auth')->prefix('dashboard')->group(function() {
    Route::redirect('/', '/dashboard/poors');
    Route::resource('poors', 'PoorsController')->except('show');
    Route::prefix('poors/{poor_id}')->group(function() {
        Route::resource('payments', 'Poors\PaymentsController')->except('show');
        Route::resource('nch', 'Poors\NonCashHelpsController')->except('show');
    });
});

require __DIR__.'/auth.php';
