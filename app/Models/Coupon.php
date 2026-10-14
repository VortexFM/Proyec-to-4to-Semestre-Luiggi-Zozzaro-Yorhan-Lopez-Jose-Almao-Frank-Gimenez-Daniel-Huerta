<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'code',
        'discount',
        'min_amount',
        'valid_from',
        'valid_until',
        'max_uses',
        'uses',
        'active',
    ];

    protected $casts = [
        'discount'    => 'decimal:2',
        'min_amount'  => 'decimal:2',
        'valid_from'  => 'date',
        'valid_until' => 'date',
        'active'      => 'boolean',
        'max_uses'    => 'integer',
        'uses'        => 'integer',
    ];

    /**
     * Relación con el usuario que lo creó
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Verificar si el cupón es válido
     */
    public function isValid(): bool
    {
        if (!$this->active) return false;
        if ($this->valid_until && $this->valid_until->isPast()) return false;
        if ($this->valid_from && $this->valid_from->isFuture()) return false;
        if ($this->max_uses && $this->uses >= $this->max_uses) return false;
        return true;
    }

    /**
     * Calcular descuento sobre un monto
     * NOTA: discount es un porcentaje (ej: 15 = 15%)
     */
    public function calculateDiscount(float $amount): float
    {
        if ($this->min_amount && $amount < $this->min_amount) return 0;
        return round(($amount * $this->discount) / 100, 2);
    }
}