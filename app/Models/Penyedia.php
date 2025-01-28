<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyedia extends Model
{
    protected $table = 'penyedia';
    protected $primaryKey = 'penyedia_id';

    protected $guarded = ['penyedia_id'];

    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function kontrak()
    {
        return $this->hasMany(Kontrak::class, 'penyedia_id');
    }
}
