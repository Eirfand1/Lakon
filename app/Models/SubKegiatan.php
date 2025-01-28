<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKegiatan extends Model
{
    protected $table = 'sub_kegiatan';
    protected $primaryKey = 'sub_kegiatan_id';
    protected $guarded = ['sub_kegiatan_id'];
    use HasFactory;

    public function kontrak()
    {
        return $this->hasMany(Kontrak::class, 'sub_kegiatan_id');
    }

    public function paketPekerjaan()
    {
        return $this->belongsToMany(
            PaketPekerjaan::class,
            'paket_sub_kegiatan', 
            'sub_kegiatan_id', 
            'paket_id',
        );
    } 
}
