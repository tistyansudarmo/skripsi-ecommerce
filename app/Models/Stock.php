<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Stock extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
