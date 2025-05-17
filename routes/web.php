<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\bahan\BahanController;
use App\Http\Controllers\bahan\BahanKategoriController;
use App\Http\Controllers\bahan\BahanKeluarController;
use App\Http\Controllers\bahan\BahanMasukController;
use App\Http\Controllers\bahan\KeperluanController;
use App\Http\Controllers\bahan\SupplierController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\customer\CustomerKategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\transaksi\DownPaymentController;
use App\Http\Controllers\transaksi\InvoiceSettingController;
use App\Http\Controllers\transaksi\ManualInvoiceController;
use App\Http\Controllers\transaksi\PemesananController;
use App\Http\Controllers\transaksi\PemesananDetailController;
use App\Http\Controllers\transaksi\PenjualanController;
use App\Http\Controllers\transaksi\PenjualanDetailController;
use App\Http\Controllers\transaksi\SourceController;
use App\Models\transaksi\InvoiceSetting;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginpost', [AuthController::class, 'store'])->name('login.post');
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

Route::middleware(['auth', 'role:0,1,2,3'])->group(function () {
    // DASHBOARD
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // SETTING
    Route::get('/setting', [SettingController::class, 'setting'])->name('setting');
    Route::put('/setting', [SettingController::class, 'update'])->name('setting.update');
    // MASTER MENU CUSTOMER
    Route::prefix('cus')->group(function () {
        // CUSTOMER KATEGORI
        Route::get('/customerkategori', [CustomerKategoriController::class, 'index'])->name('customerkategori.index');
        Route::get('/customerkategori/create', [CustomerKategoriController::class, 'create'])->name('customerkategori.create');
        Route::post('/customerkategori', [CustomerKategoriController::class, 'store'])->name('customerkategori.store');
        Route::get('/customerkategori/{customerkategori}/edit', [CustomerKategoriController::class, 'edit'])->name('customerkategori.edit');
        Route::put('/customerkategori/{customerkategori}', [CustomerKategoriController::class, 'update'])->name('customerkategori.update');
        Route::delete('/customerkategori/{customerkategori}', [CustomerKategoriController::class, 'destroy'])->name('customerkategori.destroy');
        // CUSTOMER
        Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
        Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
        Route::get('/customer/{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::put('/customer/{customer}', [CustomerController::class, 'update'])->name('customer.update');
        Route::delete('/customer/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    });
    // MASTER MENU DATA BAHAN BAKU
    Route::prefix('baku')->group(function () {
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
    // PENJUALAN
    Route::prefix('transaksi')->group(function () {
        // SOURCE
        Route::get('/source', [SourceController::class, 'index'])->name('source.index');
        Route::get('/source/export', [SourceController::class, 'export'])->name('source.export');
        Route::get('/source/create', [SourceController::class, 'create'])->name('source.create');
        Route::post('/source', [SourceController::class, 'store'])->name('source.store');
        Route::get('/source/{source}/edit', [SourceController::class, 'edit'])->name('source.edit');
        Route::put('/source/{source}', [SourceController::class, 'update'])->name('source.update');
        Route::delete('/source/{source}', [SourceController::class, 'destroy'])->name('source.destroy');
        // PENJUALAN
        Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
        Route::get('/penjualan/export', [PenjualanController::class, 'export'])->name('penjualan.export');
        Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
        Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
        Route::get('/penjualan/{penjualan}/edit', [PenjualanController::class, 'edit'])->name('penjualan.edit');
        Route::put('/penjualan/{penjualan}', [PenjualanController::class, 'update'])->name('penjualan.update');
        Route::delete('/penjualan/{penjualan}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
        Route::get('/penjualan/{penjualan}/view', [PenjualanController::class, 'view'])->name('penjualan.view');
        Route::get('/penjualan/{penjualan}/print', [PenjualanController::class, 'print'])->name('penjualan.print');
        // PEMESANAN
        Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
        Route::get('/pemesanan/export', [PemesananController::class, 'export'])->name('pemesanan.export');
        Route::get('/pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
        Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
        Route::get('/pemesanan/{pemesanan}/edit', [PemesananController::class, 'edit'])->name('pemesanan.edit');
        Route::put('/pemesanan/{pemesanan}', [PemesananController::class, 'update'])->name('pemesanan.update');
        Route::delete('/pemesanan/{pemesanan}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');
        Route::get('/pemesanan/{pemesanan}/view', [PemesananController::class, 'view'])->name('pemesanan.view');
        Route::get('/pemesanan/{pemesanan}/print', [PemesananController::class, 'print'])->name('pemesanan.print');
        // MANUAL INVOICE
        Route::get('/manualinvoice', [ManualInvoiceController::class, 'index'])->name('manualinvoice.index');
        Route::get('/manualinvoice/export', [ManualInvoiceController::class, 'export'])->name('manualinvoice.export');
        Route::get('/manualinvoice/create', [ManualInvoiceController::class, 'create'])->name('manualinvoice.create');
        Route::post('/manualinvoice', [ManualInvoiceController::class, 'store'])->name('manualinvoice.store');
        Route::get('/manualinvoice/{manualinvoice}/edit', [ManualInvoiceController::class, 'edit'])->name('manualinvoice.edit');
        Route::put('/manualinvoice/{manualinvoice}', [ManualInvoiceController::class, 'update'])->name('manualinvoice.update');
        Route::delete('/manualinvoice/{manualinvoice}', [ManualInvoiceController::class, 'destroy'])->name('manualinvoice.destroy');
        Route::get('/manualinvoice/{manualinvoice}/view', [ManualInvoiceController::class, 'view'])->name('manualinvoice.view');
        Route::get('/manualinvoice/{manualinvoice}/print', [ManualInvoiceController::class, 'print'])->name('manualinvoice.print');
        // DOWN PAYMENT
        Route::get('/downpayment', [DownPaymentController::class, 'index'])->name('downpayment.index');
        Route::get('/downpayment/export', [DownPaymentController::class, 'export'])->name('downpayment.export');
        Route::get('/downpayment/create', [DownPaymentController::class, 'create'])->name('downpayment.create');
        Route::post('/downpayment', [DownPaymentController::class, 'store'])->name('downpayment.store');
        Route::get('/downpayment/{downpayment}/edit', [DownPaymentController::class, 'edit'])->name('downpayment.edit');
        Route::put('/downpayment/{downpayment}', [DownPaymentController::class, 'update'])->name('downpayment.update');
        Route::delete('/downpayment/{downpayment}', [DownPaymentController::class, 'destroy'])->name('downpayment.destroy');
        // DOWN PAYMENT
        Route::get('/invoicesetting', [InvoiceSettingController::class, 'index'])->name('invoicesetting.index');
        Route::put('/invoicesetting', [InvoiceSettingController::class, 'update'])->name('invoicesetting.update');
    });
});
