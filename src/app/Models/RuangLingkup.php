<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangLingkup extends Model
{
    use HasFactory;
    protected $primaryKey = 'ruang_lingkup_id';
    protected $table = 'ruang_lingkup';
    protected $guarded = ['ruang_lingkup_id'];

    public function kontrak(){
        return $this->belongsTo(Kontrak::class, 'kontrak_id', 'kontrak_id');
    }
}
