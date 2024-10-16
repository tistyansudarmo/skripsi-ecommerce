<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function stock() {
        return $this->hasOne(Stock::class);
    }

    public function detailTransaction() {
        return $this->hasMany(detail_transaction::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
