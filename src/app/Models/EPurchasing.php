<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EPurchasing extends Model
{
    use HasFactory;

    protected $primaryKey = 'e_purchasing_id';
    protected $table = 'e_purchasing';
    protected $guarded = ['e_purchasing_id'];

    public function kontrak(){
        return $this->belongsTo(Kontrak::class, 'kontrak_id', 'kontrak_id');
    }
}
