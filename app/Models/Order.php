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
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
    ];

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
