<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
        'approved',
    ];

    protected $casts = [
        'rating' => 'integer',
        'approved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: una reseña pertenece a un producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Scope: solo reseñas aprobadas
    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    // Scope: reseñas de un producto específico
    public function scopeForProduct($query, $productId)
    {
        return $query->where('product_id', $productId);
    }

    // Scope: reseñas con cierta calificación mínima
    public function scopeMinRating($query, $rating)
    {
        return $query->where('rating', '>=', $rating);
    }
}
