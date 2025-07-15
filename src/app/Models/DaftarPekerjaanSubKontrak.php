<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPekerjaanSubKontrak extends Model
{
    use HasFactory;
    protected $primaryKey = 'daftar_pekerjaan_sub_kontrak_id';
    protected $table = 'daftar_pekerjaan_sub_kontrak';
    protected $guarded = ['daftar_pekerjaan_sub_kontrak_id'];

    public function kontrak(){
        return $this->belongsTo(Kontrak::class, 'kontrak_id', 'kontrak_id');
    }

}
