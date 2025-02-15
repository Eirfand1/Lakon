<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';
    protected $primaryKey = 'sekolah_id';
    protected $guarded = ['sekolah_id'];
    use HasFactory;

    public function paketPekerjaan()
    {
        return $this->belongsToMany(
            PaketPekerjaan::class,
            'sekolah',
            'sekolah_id',
            'sekolah_id',
        );
    }
}
