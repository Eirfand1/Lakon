<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\PaketPekerjaan;
use App\Models\NoKontrakTracker;
use Log;

class ProcessYearly implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Log::info('Memulai proses pergantian tahun...');

            $no_kontrak_terakhir = PaketPekerjaan::latest('paket_id')->first();

            if ($no_kontrak_terakhir) {
                NoKontrakTracker::where('id', 1)->update([
                    'id_kontrak_last_year' => $no_kontrak_terakhir->paket_id
                ]);
                Log::info('Berhasil update id_kontrak_last_year: '.$no_kontrak_terakhir->paket_id);
            } else {
                Log::warning('Tidak ada data PaketPekerjaan ditemukan');
            }
        } catch (\Exception $e) {
            Log::error('Gagal menjalankan ProcessYearly: '.$e->getMessage());
            $this->fail($e);
        }
    }
}
