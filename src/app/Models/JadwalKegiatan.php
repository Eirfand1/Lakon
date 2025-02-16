<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKegiatan extends Model
{
    use HasFactory;
    protected $primaryKey = 'jadwal_kegiatan_id';
    protected $table = 'jadwal_kegiatan';
    protected $guarded = ['jadwal_kegiatan'];

    public function kontrak(){
        return $this->belongsTo(Kontrak::class, 'kontrak_id', 'kontrak_id');
    }
}
