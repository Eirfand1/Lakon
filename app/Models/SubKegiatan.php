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

    public function paketPekerjaan()
    {
        return $this->hasMany(PaketPekerjaan::class, 'sub_kegiatan_id', 'sub_kegiatan_id');
    }
}
