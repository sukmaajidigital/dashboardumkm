<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/produk/{id}', function ($id) {
    return \App\Models\postingan\Produk::select('id', 'name', 'harga')->findOrFail($id);
});
