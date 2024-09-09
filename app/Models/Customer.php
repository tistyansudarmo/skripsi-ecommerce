<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    public $timestamps = false;
    use HasFactory, Notifiable;
    protected $guarded = ['customers'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function transaction() {
        return $this->hasMany(Transaction::class);
    }

    public function product() {
        return $this->hasMany(Product::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
