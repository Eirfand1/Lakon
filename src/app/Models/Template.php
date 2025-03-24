<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = ['name', 'file_path'];
    protected $primaryKey = 'template_id';

    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class, 'template_id');
    }
}
