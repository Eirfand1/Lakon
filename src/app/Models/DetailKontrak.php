<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKontrak extends Model
{
    use HasFactory;

    protected $primaryKey = 'detail_kontrak_id';
    protected $table = 'detail_kontrak';
    protected $guarded = ['detail_kontrak_id'];

    public function kontrak(){
        return $this->belongsTo(Kontrak::class, 'kontrak_id', 'kontrak_id');
    }
}
