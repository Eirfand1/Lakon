<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppkom extends Model
{
    protected $table = 'ppkom';
    protected $fillable = [
        'nip',
        'nama',
        'pangkat',
        'jabatan',
        'alamat',
        'no_telp',
        'email'
    ];
    use HasFactory;
}
