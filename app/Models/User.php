<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email', 
        'password',
        'role',
        'avatar',
        'bio',
        'preferences',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'preferences' => 'array',
    ];

    /**
     * Los valores por defecto para nuevos usuarios
     */
    protected $attributes = [
        'role' => 'hobbyist',
        'status' => 'active',
    ];

    // Métodos para verificar roles
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isProfessional()
    {
        return $this->role === 'professional';
    }

    public function isHobbyist()
    {
        return $this->role === 'hobbyist';
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    // Método para obtener las funcionalidades según el rol
    public function getFeaturesByRole()
    {
        $features = [
            'admin' => [
                'database_admin' => true,
                'user_management' => true,
                'system_settings' => true,
                'analytics' => true,
                'all_recipes' => true,
                'inventory_management' => true,
                'travel_mode' => true,
                'recipe_creation' => true,
                'notes' => true,
            ],
            'professional' => [
                'database_admin' => false,
                'user_management' => false,
                'system_settings' => false,
                'analytics' => true,
                'all_recipes' => true,
                'inventory_management' => true,
                'travel_mode' => true,
                'recipe_creation' => true,
                'notes' => true,
                'professional_tools' => true,
            ],
            'hobbyist' => [
                'database_admin' => false,
                'user_management' => false,
                'system_settings' => false,
                'analytics' => false,
                'all_recipes' => false,
                'inventory_management' => true,
                'travel_mode' => true,
                'recipe_creation' => true,
                'notes' => true,
                'professional_tools' => false,
            ],
        ];

        return $features[$this->role] ?? $features['hobbyist'];
    }

    
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'user_ingredients');
    }

    /**
     * Evento boot para garantizar valores por defecto
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($user) {
            // Asegurar que el rol se establece como hobbyist si no se especifica
            if (empty($user->role)) {
                $user->role = 'hobbyist';
            }
            // Asegurar que el status se establece como active si no se especifica
            if (empty($user->status)) {
                $user->status = 'active';
            }
        });
    }
}



