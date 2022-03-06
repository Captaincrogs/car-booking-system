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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/reservations', [App\Http\Controllers\ReservationController::class, 'index'])->name('reservations');
Route::get('/newReservation', [App\Http\Controllers\ReservationController::class, 'create'])->name('newReservation');
Route::get('/cars', [App\Http\Controllers\CarController::class, 'index'])->name('cars');
Route::get('/cars/{car}', [App\Http\Controllers\CarController::class, 'store'])->name('cars.store');
Route::get('/invoices', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoices');