<?php

use App\Http\Controllers\PaketPekerjaanController;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\PpkomController;
use App\Http\Controllers\VerifikatorController;
use App\Models\Penyedia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Models\Verifikator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::view('/', 'pages.landing-page');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/analytics', [DashboardController::class, 'analytics'])->name('analytics');
    Route::get('/dashboard/fintech', [DashboardController::class, 'fintech'])->name('fintech');


    // PPKOM route
    Route::prefix('adm/ppkom')->group(function () {
        Route::get('/', [PpkomController::class, 'index'])->name('adm.ppkom.index'); // Display all data
        Route::post('/', [PpkomController::class, 'store'])->name('adm.ppkom.store'); // Create new data
        Route::put('/{ppkom}', [PpkomController::class, 'update'])->name('adm.ppkom.update'); // Update data
        Route::delete('/{ppkom}', [PpkomController::class, 'destroy'])->name('adm.ppkom.destroy'); // Delete data
    });

    // Verifikator Route
    Route::prefix('adm/verifikator')->group(function () {
        Route::get('/', [VerifikatorController::class, 'index'])->name('adm.verifikator.index');
        Route::post('/', [VerifikatorController::class, 'store'])->name('adm.verifikator.store');
        Route::put('/{verifikator}', [VerifikatorController::class, 'update'])->name('adm.ppkom.edit');
        Route::delete('/{verifikator}', [VerifikatorController::class, 'destroy'])->name('adm.verifikator.destroy');
    });

    Route::get('/penyedia', [PenyediaController::class, 'index'])->name('penyedia');

    Route::get('/paket-pekerjaan', [PaketPekerjaanController::class, 'index'])->name('paket-pekerjaan');

    Route::get('/calendar', function () {
        return view('pages/calendar');
    })->name('calendar');
    Route::get('/settings/account', function () {
        return view('pages/settings/account');
    })->name('account');
    Route::get('/settings/notifications', function () {
        return view('pages/settings/notifications');
    })->name('notifications');
    Route::get('/settings/apps', function () {
        return view('pages/settings/apps');
    })->name('apps');
    Route::get('/settings/plans', function () {
        return view('pages/settings/plans');
    })->name('plans');
    Route::get('/settings/billing', function () {
        return view('pages/settings/billing');
    })->name('billing');
    Route::get('/settings/feedback', function () {
        return view('pages/settings/feedback');
    })->name('feedback');
    Route::get('/utility/404', function () {
        return view('pages/utility/404');
    })->name('404');
    Route::fallback(function () {
        return view('pages/utility/404');
    });
});
