<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('ph')->group(function () {
    Route::view('/beranda', 'pemohon.index')->name('beranda');
    Route::view('/riwayat-kontrak', 'pemohon.riwayat-kontrak')->name('riwayat-kontrak');
});
