<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'province_id'];

    // Relasi ke Province
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
