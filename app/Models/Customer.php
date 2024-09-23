<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    public $timestamps = false;
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
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

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    // Relasi ke City
    public function city()
    {
        return $this->belongsTo(Cities::class);
    }
}
