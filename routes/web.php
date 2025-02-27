<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('page.welcome');
})->name('dashboard');
Route::get('/sample', function () {
    return view('page.customer.sample');
})->name('sampledata');
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/customer/data', [CustomerController::class, 'getData'])->name('customer.data');
Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer/{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/customer/{customer}', [CustomerController::class, 'update'])->name('customer.update');
Route::delete('/customer/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');
