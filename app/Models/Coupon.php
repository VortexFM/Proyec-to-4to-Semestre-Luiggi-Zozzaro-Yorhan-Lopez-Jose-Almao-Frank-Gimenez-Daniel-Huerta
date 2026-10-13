<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount',
        'min_amount',
        'valid_from',
        'valid_until',
        'max_uses',
        'uses',
        'active',
        'created_by',  // ← Nuevo campo
    ];

    protected $casts = [
        'discount' => 'decimal:2',
        'min_amount' => 'decimal:2',
        'valid_from' => 'date',
        'valid_until' => 'date',
        'uses' => 'integer',
        'max_uses' => 'integer',
        'active' => 'boolean',
    ];

    /**
     * Relación: un cupón fue creado por un usuario
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Verifica si el cupón es válido para usar
     */
    public function isValid()
    {
        if (!$this->active) {
            return false;
        }

        if ($this->valid_from && Carbon::now()->lt($this->valid_from)) {
            return false;
        }

        if ($this->valid_until && Carbon::now()->gt($this->valid_until)) {
            return false;
        }

        if ($this->max_uses && $this->uses >= $this->max_uses) {
            return false;
        }

        return true;
    }

    /**
     * Calcula el descuento a aplicar sobre un monto
     */
    public function calculateDiscount($amount)
    {
        if ($this->min_amount && $amount < $this->min_amount) {
            return 0;
        }

        return ($amount * $this->discount) / 100;
    }

    /**
     * Scope: solo cupones activos
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope: cupones vigentes
     */
    public function scopeValid($query)
    {
        $now = Carbon::now();

        return $query->where('active', true)
            ->where('valid_from', '<=', $now)
            ->where('valid_until', '>=', $now)
            ->where(function ($q) {
                $q->whereNull('max_uses')
                  ->orWhereColumn('uses', '<', 'max_uses');
            });
    }
}