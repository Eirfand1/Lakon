<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSubKegiatan extends Model
{
    use HasFactory;
    protected $table = 'paket_sub_kegiatan'; 
    protected $primaryKey = 'paket_sub_kegiatan_id';
    protected $fillable = ['paket_id', 'sub_kegiatan_id'];
}
