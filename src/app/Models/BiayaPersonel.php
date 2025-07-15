<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaPersonel extends Model
{
    use HasFactory;
    protected $primaryKey = 'biaya_personel_id';
    protected $table = 'biaya_personel';
    protected $guarded = ['biaya_personel_id'];

    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class, 'kontrak_id', 'kontrak_id');
    }
}
