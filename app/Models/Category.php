<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'slug', 
        'description', 
        'icon', 
        'parent_id',
        'ative',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

     public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Relación: una categoría puede tener una categoría padre
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Relación: una categoría puede tener muchas subcategorías
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
