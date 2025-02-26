<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenKontrak extends Model
{
    use HasFactory;

    protected $primaryKey = 'dokumen_id';
    protected $table = 'dokumen_kontrak';
    protected $guarded = ['dokumen_id'];

    public function kontrak(){
        return $this->belongsTo(Kontrak::class, 'kontrak_id', 'kontrak_id');
    }
}
