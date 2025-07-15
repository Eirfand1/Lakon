<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarKeluaranDanHarga extends Model
{
    use HasFactory;
    protected $primaryKey = 'daftar_keluaran_dan_harga_id';
    protected $table = 'daftar_keluaran_dan_harga';
    protected $guarded = ['daftar_keluaran_dan_harga_id'];

    public function kontrak(){
        return $this->belongsTo(Kontrak::class, 'kontrak_id', 'kontrak_id');
    }
}
