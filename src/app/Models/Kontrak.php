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

    public function tim()
    {
        return $this->hasMany(Tim::class, 'kontrak_id', 'kontrak_id');
    }

    public function jadwalKegiatan()
    {
        return $this->hasMany(JadwalKegiatan::class, 'kontrak_id', 'kontrak_id');
    }

    public function rincianBelanja()
    {
        return $this->hasMany(RincianBelanja::class, 'kontrak_id', 'kontrak_id');
    }

    public function peralatan()
    {
        return $this->hasMany(Peralatan::class, 'kontrak_id', 'kontrak_id');
    }

    public function ruangLingkup()
    {
        return $this->hasMany(RuangLingkup::class, 'kontrak_id', 'kontrak_id');
    }

    public function realisasi()
    {
        return $this->hasMany(Realisasi::class, 'kontrak_id', 'kontrak_id');
    }
}
