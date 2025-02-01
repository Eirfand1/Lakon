<?php

use App\Http\Controllers\DasarHukumController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\PaketPekerjaanController;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\PpkomController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\VerifikatorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;

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
Route::get('/registrasi', [PenyediaController::class, 'create'])->name('registrasi');
Route::post('/registrasi', [PenyediaController::class, 'store'])->name('registrasi.store');

Route::middleware(['auth', 'role:penyedia'])->prefix('/penyedia')->group(function () {
    Route::get('/riwayat-kontrak', [PenyediaController::class, 'kontrakSaya'])->name('penyedia.riwayat');
    Route::get('/dashboard', [PenyediaController::class, 'dashboard'])->name('penyedia.dashboard');

    Route::middleware('cekStatusPenyedia:konsultan')->group(function () {
        Route::get('/rencana', [PenyediaController::class, 'konsultanRencanaindex'])->name('penyedia.konsultan.rencana.index');
        Route::get('/realisasi', [PenyediaController::class, 'konsultanRealisasiIndex'])->name('penyedia.konsultan.realisasi.index');
    });
});

Route::middleware(['auth', 'role:verifikator'])->prefix('/verifikator')->group(function () {
    Route::get('/riwayat-kontrak', [VerifikatorController::class, 'kontrakSaya'])->name('verifikator.riwayat');
    Route::get('/dashboard', [VerifikatorController::class, 'dashboard'])->name('verifikator.dashboard');
});

// TODO make all route to /admin or /penyedia or /verifikator
Route::middleware(['auth', 'role:admin'])->prefix('/admin')->group(function () {

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // PPKOM route
    Route::prefix('/ppkom')->group(function () {
        Route::get('/', [PpkomController::class, 'index'])->name('admin.ppkom.index'); // Display all data
        Route::post('/', [PpkomController::class, 'store'])->name('admin.ppkom.store'); // Create new data
        Route::put('/{ppkom}', [PpkomController::class, 'update'])->name('admin.ppkom.update'); // Update data
        Route::delete('/{ppkom}', [PpkomController::class, 'destroy'])->name('admin.ppkom.destroy'); // Delete data
    });

    // Verifikator Route
    Route::prefix('/verifikator')->group(function () {
        Route::get('/', [VerifikatorController::class, 'index'])->name('admin.verifikator.index');
        Route::post('/', [VerifikatorController::class, 'store'])->name('admin.verifikator.store');
        Route::put('/{verifikator}', [VerifikatorController::class, 'update'])->name('admin.verifikator.edit');
        Route::delete('/{verifikator}', [VerifikatorController::class, 'destroy'])->name('admin.verifikator.destroy');
    });

    // TODO : make post route
    Route::prefix('/penyedia')->group(function () {
        Route::get('/', [PenyediaController::class, 'index'])->name('admin.penyedia.index');
        Route::put('/{penyedia}', [PenyediaController::class, 'update'])->name('admin.penyedia.edit');
        Route::delete('/{penyedia}', [PenyediaController::class, 'destroy'])->name('admin.penyedia.destroy');



    });


    Route::get('/paket-pekerjaan', [PaketPekerjaanController::class, 'index'])->name('admin.paket-pekerjaan.index');
    Route::post('/paket-pekerjaan', [PaketPekerjaanController::class, 'store'])->name('admin.paket-pekerjaan.store');
    Route::delete('/paket-pekerjaan/{paket_pekerjaan}', [PaketPekerjaanController::class, 'destroy'])->name('admin.paket-pekerjaan.destroy');

    Route::prefix('/riwayat-kontrak')->group(function () {
        Route::get('/', [KontrakController::class, 'index'])->name('admin.riwayat-kontrak.index');
        Route::get('/export', [KontrakController::class, 'export'])->name('admin.riwayat-kontrak.export');
    });

    Route::prefix('/sekolah')->group(function () {
        Route::get('/', [SekolahController::class, 'index'])->name('admin.sekolah.index');
        Route::get('/import-sekolah', [SekolahController::class, 'showImport']);
        Route::post('/import-sekolah', [SekolahController::class, 'import']);
    });

    Route::prefix('/dasar-hukum')->group(function () {
        Route::get('/', [DasarHukumController::class, 'index'])->name('admin.dasar-hukum.index');
    });




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
