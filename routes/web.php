<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

//all routes need authentication to 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/newReservation', 'ReservationController@newReservation')->name('newReservation');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/reservations', [App\Http\Controllers\ReservationController::class, 'index'])->name('reservations');
    Route::get('/newReservation', [App\Http\Controllers\ReservationController::class, 'create'])->name('newReservation');
    Route::post ('/newReservation/store', [App\Http\Controllers\ReservationController::class, 'printInvoices'])->name('newReservation/store');

    Route::post('/cars/checkout', [App\Http\Controllers\CarController::class, 'checkout']);
    Route::get('/cars', [App\Http\Controllers\CarController::class, 'index'])->name('cars');
    Route::get('/invoices', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoices');
    Route::get('/admin', [App\Http\Controllers\ReservationController::class, 'index'])->name('admin');
});
