<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoKontrakTracker extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'no_kontrak_tracker';
    protected $fillable = [
        'id_kontrak_last_year',
        'this_year',
    ];
}
