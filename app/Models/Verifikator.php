<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikator extends Model
{
    protected $table = 'verifikator';
    protected $primaryKey = 'verifikator_id';
    protected $fillable = ['user_id','nip', 'nama_verifikator'];
    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kontrak()
    {
        return $this->hasMany(Kontrak::class, 'verifikator_id');
    }


}
