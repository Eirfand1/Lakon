<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanKerja extends Model
{
    protected $table = 'satuan_kerja';

    protected $primaryKey = 'satker_id';
    protected $guarded = ['satker_id'];
    use HasFactory;


    public function paketPekerjaan()
    {
        return $this->hasMany(PaketPekerjaan::class, 'satker_id', 'satker_id');
    }
}
