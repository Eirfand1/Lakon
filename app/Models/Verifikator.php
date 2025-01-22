<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikator extends Model
{
    protected $table = 'verifikator';
    protected $fillable = ['nip', 'nama_verifikator'];
    use HasFactory;
}
