<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    use HasFactory;
    protected $primaryKey = 'peralatan_id';
    protected $table = 'peralatan';
    protected $guarded = ['peralatan_id'];

    public function kontrak(){
        return $this->belongsTo(Kontrak::class, 'kontrak_id', 'kontrak_id');
    }
}
