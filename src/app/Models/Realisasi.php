<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    use HasFactory;
    protected $primaryKey = 'realisasi_id';
    protected $table = 'realisasi';
    protected $guarded = ['realisasi_id'];


    public function kontrak(){
        return $this->belongsTo(Kontrak::class, 'kontrak_id', 'kontrak_id');
    }
}
