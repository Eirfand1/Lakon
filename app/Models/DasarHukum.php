<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DasarHukum extends Model
{
    protected $table = 'dasar_hukum';
    protected $primaryKey = 'daskum_id';

    protected $guarded = ['daskum_id'];
    use HasFactory;
}
