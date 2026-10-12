<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación: un usuario tiene muchas direcciones
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    // Relación: un usuario tiene muchos pedidos
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relación: un usuario tiene muchas reseñas
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relación: un usuario tiene muchos roles (N:M)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /**
     * Verificar si el usuario tiene un rol específico
     */
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    /**
     * Verificar si el usuario es admin
     */
    public function isAdmin()
    {
        return $this->hasRole('admin') || $this->role === 'admin';
    }

    /**
     * Verificar si el usuario es cliente
     */
    public function isCliente()
    {
        return $this->hasRole('cliente') || $this->role === 'cliente';
    }

    /**
     * Asignar un rol al usuario
     */
    public function assignRole($roleName)
    {
        $role = Role::where('name', $roleName)->first();
        if ($role && !$this->roles()->where('role_id', $role->id)->exists()) {
            $this->roles()->attach($role->id);
        }
        return $this;
    }
}