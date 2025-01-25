<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketPekerjaan extends Model
{
    protected $table = 'paket_pekerjaan';

    protected $primaryKey = 'paket_id';
    protected $guarded = ['paket_id'];
    use HasFactory;

    public function ppkom()
    {
        return $this->hasOne(Ppkom::class, 'paket_id', 'paket_id');
    }

    public function dasarHukum()
    {
        return $this->hasOne(DasarHukum::class, 'paket_id', 'paket_id');
    }

    public function satuanKerja()
    {
        return $this->belongsTo(SatuanKerja::class, 'satker_id', 'satker_id');
    }

    public function subKegiatan()
    {
        return $this->belongsTo(SubKegiatan::class, 'sub_kegiatan_id', 'id');
    }

}
