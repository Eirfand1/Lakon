<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    protected $table = 'kontrak'; 
    protected $guarded = ['kontrak_id'];
    protected $primaryKey = 'kontrak_id';
    use HasFactory;

    public function satuanKerja()
    {
        return $this->belongsTo(SatuanKerja::class, 'satker_id');
    }

    public function verifikator()
    {
        return $this->belongsTo(Verifikator::class, 'verifikator_id');
    }

    public function subKegiatan()
    {
        return $this->belongsTo(SubKegiatan::class, 'sub_kegiatan_id');
    }

    public function penyedia()
    {
        return $this->belongsTo(Penyedia::class, 'penyedia_id');
    }

    public function riwayatKontrak() {
        $verifikator = auth()->user()->verifikator;
        $kontrak = Kontrak::where('verifikator_id', $verifikator)->get();

        return view('pages.verifikator.riwayat.riwayat', compact('kontrak'));
    }

    public function paketPekerjaan(){
        return $this->belongsTo(PaketPekerjaan::class,'paket_id');
    }
}
