<?php

use App\Http\Controllers\DasarHukumController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\PaketPekerjaanController;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\SubKegiatanController;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\PpkomController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\VerifikatorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\JadwalKegiatanController;
use App\Http\Controllers\RincianBelanjaController;
use App\Http\Controllers\RuangLingkupController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\DokumenKontrakController;
use App\Http\Controllers\KeteranganKontrakController;

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
    Route::get('/permohonan-kontrak', [PenyediaController::class, 'permohonanKontrakIndex'])->name('penyedia.permohonan-kontrak.index');
    Route::post('/permohonan-kontrak', [KontrakController::class, 'store'])->name('penyedia.permohonan-kontrak.store');
    Route::get('/permohonan-kontrak/{kontrak}', [KontrakController::class, 'edit'])->name('penyedia.permohonan-kontrak.edit');
    Route::put('/permohonan-kontrak/{kontrak}', [KontrakController::class, 'update'])->name('penyedia.permohonan-kontrak.update');
    Route::post('/permohonan-kontrak/layangkan/{kontrak}', [KontrakController::class, 'layangkan'])->name('penyedia.permohonan-kontrak.layangkan');

    // lampiran kontrak
    // tim
    Route::post('/permohonan-kontrak/tim', [TimController::class, 'store'])->name('penyedia.tim.store');
    Route::delete('/permohonan-kontrak/tim/{tim}', [TimController::class, 'destroy'])->name('penyedia.tim.destroy');

    // jadwal kegiatan
    Route::post('/permohonan-kontrak/jadwal-kegiatan', [JadwalKegiatanController::class, 'store'])->name('penyedia.jadwal-kegiatan.store');
    Route::delete('/permohonan-kontrak/jadwal-kegiatan/{jadwal_kegiatan}', [JadwalKegiatanController::class, 'destroy'])->name('penyedia.jadwal-kegiatan.destroy');

    // rincian belanja
    Route::post('/permohonan-kontrak/rincian-belanja', [RincianBelanjaController::class, 'store'])->name('penyedia.rincian-belanja.store');
    Route::delete('/permohonan-kontrak/rincian-belanja/{rincian_belanja}', [RincianBelanjaController::class, 'destroy'])->name('penyedia.rincian-belanja.destroy');

    // peralatan
    Route::post('/permohonan-kontrak/peralatan', [PeralatanController::class, 'store'])->name('penyedia.peralatan.store');
    Route::delete('/permohonan-kontrak/peralatan/{peralatan}', [PeralatanController::class, 'destroy'])->name('penyedia.peralatan.destroy');

    // ruang lingkup
    Route::post('/permohonan-kontrak/ruang-lingkup', [RuangLingkupController::class, 'store'])->name('penyedia.ruang-lingkup.store');
    Route::delete('/permohonan-kontrak/ruang-lingkup/{ruang_lingkup}', [RuangLingkupController::class, 'destroy'])->name('penyedia.ruang-lingkup.destroy');


    // Edit data perusahaan
    Route::get('data-perusahaan', [PenyediaController::class, 'dataPerusahaanView'])->name('penyedia.data-perusahaan.view');
    Route::put('data-perusahaan/{penyedia}', [PenyediaController::class, 'update'])->name('penyedia.data-perusahaan.update');

    Route::middleware('cekStatusPenyedia:konsultan')->group(function () {
        Route::get('/matrik', [PenyediaController::class, 'konsultanMatrikIndex'])->name('penyedia.konsultan.matrik.index');
        Route::get('/realisasi/{kontrak_id}', [RealisasiController::class, 'realisasi'])->name('penyedia.konsultan.realisasi');
        Route::post('/realisasi/{kontrak_id}', [RealisasiController::class, 'storeRealisasi'])->name('penyedia.konsultan.realisasi.update');
    });
});

Route::middleware(['auth', 'role:verifikator'])->prefix('/verifikator')->group(function () {
    Route::get('/riwayat-kontrak', [VerifikatorController::class, 'kontrakSaya'])->name('verifikator.riwayat');
    Route::get('/dashboard', [VerifikatorController::class, 'dashboard'])->name('verifikator.dashboard');

    Route::get('/tolak/{kontrak_id}', [VerifikatorController::class, 'tolak'])->name('verifikator.tolak');
    Route::get('/detail/{kontrak_id}', [VerifikatorController::class, 'detail'])->name('verifikator.detail');

    Route::post('/detail/data-dasar/{kontrak_id}', [VerifikatorController::class, 'dataDasar']);
    Route::post('/detail/spk/{kontrak_id}', [VerifikatorController::class, 'spk']);
    Route::post('/detail/spk-done/{kontrak_id}', [VerifikatorController::class, 'spkDone']);
    Route::post('/detail/lampiran/{kontrak_id}', [VerifikatorController::class, 'lampiran']);
    Route::post('/detail/spp/{kontrak_id}', [VerifikatorController::class, 'spp']);
    Route::post('/detail/sskk/{kontrak_id}', [VerifikatorController::class, 'sskk']);
    Route::post('/detail/terima/{kontrak_id}', [VerifikatorController::class, 'terima'])->name('verifikator.terima');

    Route::post('/detail/penerima-barang', [PenerimaController::class, 'store'])->name('verifikator.penerima.store');
    Route::delete('/detail/penerima-barang/{penerima}', [PenerimaController::class, 'destroy'])->name('verifikator.penerima.destroy');

    Route::post('detail/dokumen', [DokumenKontrakController::class, 'store'])->name('verifikator.dokumen.store');
    Route::delete('detail/dokumen/{dokumen}', [DokumenKontrakController::class, 'destroy'])->name('verifikator.dokumen.destroy');

    Route::post('detail/keterangan', [KeteranganKontrakController::class, 'store'])->name('verifikator.keterangan.store');
    Route::delete('detail/keterangan/{keterangan}', [KeteranganKontrakController::class, 'destroy'])->name('verifikator.keterangan.destroy');

    // lampiran kontrak
    // tim
    Route::post('/detail/tim', [TimController::class, 'store'])->name('verifikator.tim.store');
    Route::delete('/detail/tim/{tim}', [TimController::class, 'destroy'])->name('verifikator.tim.destroy');

    // jadwal kegiatan
    Route::post('/detail/jadwal-kegiatan', [JadwalKegiatanController::class, 'store'])->name('verifikator.jadwal-kegiatan.store');
    Route::delete('/detail/jadwal-kegiatan/{jadwal_kegiatan}', [JadwalKegiatanController::class, 'destroy'])->name('verifikator.jadwal-kegiatan.destroy');

    // rincian belanja
    Route::post('/detail/rincian-belanja', [RincianBelanjaController::class, 'store'])->name('verifikator.rincian-belanja.store');
    Route::delete('/detail/rincian-belanja/{rincian_belanja}', [RincianBelanjaController::class, 'destroy'])->name('verifikator.rincian-belanja.destroy');

    // peralatan
    Route::post('/detail/peralatan', [PeralatanController::class, 'store'])->name('verifikator.peralatan.store');
    Route::delete('/detail/peralatan/{peralatan}', [PeralatanController::class, 'destroy'])->name('verifikator.peralatan.destroy');

    // ruang lingkup
    Route::post('/detail/ruang-lingkup', [RuangLingkupController::class, 'store'])->name('verifikator.ruang-lingkup.store');
    Route::delete('/detail/ruang-lingkup/{ruang_lingkup}', [RuangLingkupController::class, 'destroy'])->name('verifikator.ruang-lingkup.destroy');
});

// TODO make all route to /admin or /penyedia or /verifikator
Route::middleware(['auth', 'role:admin'])->prefix('/admin')->group(function () {

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    // Dashboard
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::put('/{pimpinan}', [DashboardController::class, 'update'])->name('admin.dashboard.update');
    });
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

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
        Route::Get('/export', [PenyediaController::class, 'exportPenyedia'])->name('admin.penyedia.export');
    });

    // Paket Pekerjaan (Matriks)
    Route::get('/paket-pekerjaan', [PaketPekerjaanController::class, 'index'])->name('admin.paket-pekerjaan.index');
    Route::post('/paket-pekerjaan', [PaketPekerjaanController::class, 'store'])->name('admin.paket-pekerjaan.store');
    Route::delete('/paket-pekerjaan/{paket_pekerjaan}', [PaketPekerjaanController::class, 'destroy'])->name('admin.paket-pekerjaan.destroy');
    Route::put('/paket-pekerjaan/{paket_pekerjaan}', [PaketPekerjaanController::class, 'update'])->name('admin.paket-pekerjaan.update');
    Route::get('/paket-pekerjaan/export', [PaketPekerjaanController::class, 'exportPaketPekerjaan'])->name('admin.paket-pekerjaan.export');


    // Realisasi
    Route::get('/realisasi', [RealisasiController::class, 'index'])->name('admin.realisasi.index');


    // Sub Kegiatan
    Route::prefix('/sub-kegiatan')->group(function () {
        Route::get('/', [SubKegiatanController::class, 'index'])->name('admin.sub-kegiatan.index');
        Route::post('/', [SubKegiatanController::class, 'store'])->name('admin.sub-kegiatan.store');
        Route::put('/{sub_kegiatan}', [SubKegiatanController::class, 'update'])->name('admin.sub-kegiatan.edit');
        Route::delete('/{sub_kegiatan}', [SubKegiatanController::class, 'destroy'])->name('admin.sub-kegiatan.destroy');
    });

    Route::prefix('/riwayat-kontrak')->group(function () {
        Route::get('/', [KontrakController::class, 'index'])->name('admin.riwayat-kontrak.index');
        Route::get('/{kontrak}', [KontrakController::class, 'show'])->name('admin.riwayat-kontrak.show');
        Route::get('/export', [KontrakController::class, 'export'])->name('admin.riwayat-kontrak.export');
        Route::get('/{kontrak}/export-pdf', [KontrakController::class, 'exportPdf'])->name('admin.riwayat-kontrak.export-pdf');
    });

    Route::prefix('/sekolah')->group(function () {
        Route::get('/', [SekolahController::class, 'index'])->name('admin.sekolah.index');
        Route::get('/import-sekolah', [SekolahController::class, 'showImport']);
        Route::post('/import-sekolah', [SekolahController::class, 'import']);
        Route::post('/', [SekolahController::class, 'store'])->name('admin.sekolah.store');
        Route::put('/{sekolah}', [SekolahController::class, 'update'])->name('admin.sekolah.update');
        Route::delete('/{sekolah}', [SekolahController::class, 'destroy'])->name('admin.sekolah.destroy');
    });

    Route::prefix('/dasar-hukum')->group(function () {
        Route::get('/', [DasarHukumController::class, 'index'])->name('admin.dasar-hukum.index');
        Route::post('/', [DasarHukumController::class, 'store'])->name('admin.dasar-hukum.store');
        Route::put('/{dasar_hukum}', [DasarHukumController::class, 'update'])->name('admin.dasar-hukum.update');
        Route::delete('/{dasar_hukum}', [DasarHukumController::class, 'destroy'])->name('admin.dasar-hukum.destroy');
    });


    Route::prefix('/template')->group(function() {
        Route::get('/', [TemplateController::class, 'index'])->name('admin.template.index');
        Route::post('/', [TemplateController::class, 'store'])->name('admin.template.store');
        Route::delete('/{template}', [TemplateController::class, 'destroy'])->name('admin.template.destroy');
    });


    Route::get('/utility/404', function () {
        return view('pages/utility/404');
    })->name('404');
    Route::fallback(function () {
        return view('pages/utility/404');
    });
});
