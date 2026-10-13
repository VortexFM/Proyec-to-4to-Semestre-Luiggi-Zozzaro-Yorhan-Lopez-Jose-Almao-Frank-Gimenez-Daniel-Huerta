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
        'estado',
        'municipio',
        'parroquia',
        'ciudad',
        'urbanizacion',
        'calle',
        'casa',
        'punto_referencia',
        'codigo_postal',
        'default',
    ];

    protected $casts = [
        'default' => 'boolean',
    ];

    // Relación: una dirección pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: una dirección puede estar en muchos pedidos
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Accessor: devuelve la dirección completa
    public function getFullAddressAttribute()
    {
        $partes = array_filter([
            $this->calle,
            $this->casa,
            $this->urbanizacion,
            $this->parroquia,
            $this->municipio,
            $this->estado,
        ]);

        return implode(', ', $partes);
    }
}