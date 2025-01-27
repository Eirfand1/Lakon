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
        return $this->hasOne(Ppkom::class, 'ppkom_id', 'ppkom_id');
    }

    public function dasarHukum()
    {
        return $this->hasOne(DasarHukum::class, 'daskum_id', 'daskum_id');
    }

    public function satuanKerja()
    {
        return $this->belongsTo(SatuanKerja::class, 'satker_id', 'satker_id');
    }

    public function subKegiatan()
    {

        return $this->belongsToMany(
            SubKegiatan::class,
            'paket_sub_kegiatan', 
            'paket_id', 
            'sub_kegiatan_id'
        );
    }

}
