<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianBelanja extends Model
{
    use HasFactory;
    protected $primaryKey = 'rincian_belanja_id';
    protected $table = 'rincian_belanja';
    protected $guarded = ['rincian_belanja_id'];

    public function kontrak(){
        return $this->belongsTo(Kontrak::class, 'kontrak_id', 'kontrak_id');
    }
}
