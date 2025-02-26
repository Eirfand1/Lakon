<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeteranganKontrak extends Model
{
    use HasFactory;

    protected $primaryKey = 'keterangan_id';
    protected $table = 'keterangan_kontrak';
    protected $guarded = ['keterangan_id'];

    public function kontrak(){
        return $this->belongsTo(Kontrak::class, 'kontrak_id', 'kontrak_id');
    }
}
