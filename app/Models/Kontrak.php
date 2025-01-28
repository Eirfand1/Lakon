<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    protected $table = 'kontrak'; 
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
}
