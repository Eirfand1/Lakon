<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    use HasFactory;

    protected $primaryKey = 'penerima_id';
    protected $table = 'penerima';
    protected $guarded = ['penerima_id'];

    public function kontrak(){
        return $this->belongsTo(Kontrak::class, 'kontrak_id', 'kontrak_id');
    }
}
