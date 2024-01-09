<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\stocks;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function stock() {
        return $this->hasOne(stocks::class);
    }
}
