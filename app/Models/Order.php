<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'order_number',
        'subtotal',
        'shipping',
        'tax',
        'total',
        'status',
        'payment_method',
        'notes',
        // Campos de dirección de envío (snapshot)
        'shipping_name',
        'shipping_phone',
        'shipping_estado',
        'shipping_municipio',
        'shipping_parroquia',
        'shipping_ciudad',
        'shipping_urbanizacion',
        'shipping_calle',
        'shipping_casa',
        'shipping_punto_referencia',
        'shipping_codigo_postal',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // Relación: un pedido pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: un pedido tiene una dirección de envío
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    // Relación: un pedido tiene muchos items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Accessor: devuelve la dirección de envío completa
    public function getFullShippingAddressAttribute()
    {
        $partes = array_filter([
            $this->shipping_calle,
            $this->shipping_casa,
            $this->shipping_urbanizacion,
            $this->shipping_parroquia,
            $this->shipping_municipio,
            $this->shipping_estado,
        ]);

        return implode(', ', $partes);
    }

    // Accessor: devuelve la cantidad total de productos
    public function getTotalItemsAttribute()
    {
        return $this->items()->sum('quantity');
    }

    // Scope: solo pedidos pendientes
    public function scopePending($query)
    {
        return $query->where('status', 'pendiente');
    }

    // Scope: solo pedidos entregados
    public function scopeDelivered($query)
    {
        return $query->where('status', 'entregado');
    }

    // Scope: pedidos de un usuario específico
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}