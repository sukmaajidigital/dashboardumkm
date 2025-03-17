<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\BahanKeluarController;
use App\Http\Controllers\BahanMasukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BahanKategoriController;
use App\Http\Controllers\CustomerKategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeperluanController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginpost', [AuthController::class, 'store'])->name('login.post');
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
Route::middleware(['auth', 'role:0,1,2,3'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/setting', [SettingController::class, 'setting'])->name('setting');
    Route::put('/setting', [SettingController::class, 'update'])->name('setting.update');
    // MASTER MENU CUSTOMER
    Route::get('/customerkategori', [CustomerKategoriController::class, 'index'])->name('customerkategori.index');
    Route::get('/customerkategori/create', [CustomerKategoriController::class, 'create'])->name('customerkategori.create');
    Route::post('/customerkategori', [CustomerKategoriController::class, 'store'])->name('customerkategori.store');
    Route::get('/customerkategori/{customerkategori}/edit', [CustomerKategoriController::class, 'edit'])->name('customerkategori.edit');
    Route::put('/customerkategori/{customerkategori}', [CustomerKategoriController::class, 'update'])->name('customerkategori.update');
    Route::delete('/customerkategori/{customerkategori}', [CustomerKategoriController::class, 'destroy'])->name('customerkategori.destroy');

    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/{customer}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    // MASTER MENU DATA BAHAN BAKU
    // Kategrori
    Route::get('/bahankategori', [BahanKategoriController::class, 'index'])->name('bahankategori.index');
    Route::get('/bahankategori/create', [BahanKategoriController::class, 'create'])->name('bahankategori.create');
    Route::post('/bahankategori', [BahanKategoriController::class, 'store'])->name('bahankategori.store');
    Route::get('/bahankategori/{bahankategori}/edit', [BahanKategoriController::class, 'edit'])->name('bahankategori.edit');
    Route::put('/bahankategori/{bahankategori}', [BahanKategoriController::class, 'update'])->name('bahankategori.update');
    Route::delete('/bahankategori/{bahankategori}', [BahanKategoriController::class, 'destroy'])->name('bahankategori.destroy');

    // Bahan
    Route::get('/bahan', [BahanController::class, 'index'])->name('bahan.index');
    Route::get('/bahan/data', [BahanController::class, 'getData'])->name('bahan.getData');
    Route::get('/bahan/create', [BahanController::class, 'create'])->name('bahan.create');
    Route::post('/bahan', [BahanController::class, 'store'])->name('bahan.store');
    Route::get('/bahan/{bahan}/edit', [BahanController::class, 'edit'])->name('bahan.edit');
    Route::put('/bahan/{bahan}', [BahanController::class, 'update'])->name('bahan.update');
    Route::delete('/bahan/{bahan}', [BahanController::class, 'destroy'])->name('bahan.destroy');

    // Keperluan
    Route::get('/keperluan', [KeperluanController::class, 'index'])->name('keperluan.index');
    Route::get('/keperluan/create', [KeperluanController::class, 'create'])->name('keperluan.create');
    Route::post('/keperluan', [KeperluanController::class, 'store'])->name('keperluan.store');
    Route::get('/keperluan/{keperluan}/edit', [KeperluanController::class, 'edit'])->name('keperluan.edit');
    Route::put('/keperluan/{keperluan}', [KeperluanController::class, 'update'])->name('keperluan.update');
    Route::delete('/keperluan/{keperluan}', [KeperluanController::class, 'destroy'])->name('keperluan.destroy');

    // Supplier
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/supplier/export', [SupplierController::class, 'export'])->name('supplier.export');
    Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/supplier/{supplier}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/supplier/{supplier}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/supplier/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');



    // Bahan Masuk
    Route::get('/bahanmasuk', [BahanMasukController::class, 'index'])->name('bahanmasuk.index');
    Route::get('/bahanmasuk/export', [BahanMasukController::class, 'export'])->name('bahanmasuk.export');
    Route::get('/bahanmasuk/create', [BahanMasukController::class, 'create'])->name('bahanmasuk.create');
    Route::post('/bahanmasuk', [BahanMasukController::class, 'store'])->name('bahanmasuk.store');
    Route::get('/bahanmasuk/{bahanmasuk}/edit', [BahanMasukController::class, 'edit'])->name('bahanmasuk.edit');
    Route::put('/bahanmasuk/{bahanmasuk}', [BahanMasukController::class, 'update'])->name('bahanmasuk.update');
    Route::delete('/bahanmasuk/{bahanmasuk}', [BahanMasukController::class, 'destroy'])->name('bahanmasuk.destroy');
    Route::get('/bahan/export-excel', [BahanController::class, 'exportExcel'])->name('bahan.exportExcel');


    // Bahan Keluar
    Route::get('/bahankeluar', [BahanKeluarController::class, 'index'])->name('bahankeluar.index');
    Route::get('/bahankeluar/export', [BahanKeluarController::class, 'export'])->name('bahankeluar.export');
    Route::get('/bahankeluar/create', [BahanKeluarController::class, 'create'])->name('bahankeluar.create');
    Route::post('/bahankeluar', [BahanKeluarController::class, 'store'])->name('bahankeluar.store');
    Route::get('/bahankeluar/{bahankeluar}/edit', [BahanKeluarController::class, 'edit'])->name('bahankeluar.edit');
    Route::put('/bahankeluar/{bahankeluar}', [BahanKeluarController::class, 'update'])->name('bahankeluar.update');
    Route::delete('/bahankeluar/{bahankeluar}', [BahanKeluarController::class, 'destroy'])->name('bahankeluar.destroy');
});
