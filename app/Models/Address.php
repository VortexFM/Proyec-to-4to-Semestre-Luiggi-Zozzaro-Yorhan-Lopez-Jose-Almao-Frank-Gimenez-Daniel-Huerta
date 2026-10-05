<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'default',
    ];

    protected $casts = [
        'default' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: una dirección puede estar en muchos pedidos
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Accessor: devuelve la dirección completa en un solo string
    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->city}, {$this->state}";
    }
    
}
