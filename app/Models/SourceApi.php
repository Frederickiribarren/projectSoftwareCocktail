<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SourceApi extends Model
{
    use HasFactory;

    protected $table = 'source_apis';

    protected $fillable = [
        'name',
        'token',
        'base_url',
        'description',
        'is_active',
        'last_used_at',
        'rate_limit',
        'rate_limit_reset_interval'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_used_at' => 'datetime',
        'rate_limit' => 'integer',
        'rate_limit_reset_interval' => 'integer'
    ];

    /**
     * Obtiene los ingredientes que provienen de esta API
     */
    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class, 'source_api_id');
    }

    /**
     * Obtiene las recetas que provienen de esta API
     */
    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class, 'source_api_id');
    }

    /**
     * Verifica si la API está activa y disponible
     */
    public function isAvailable(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->last_used_at && $this->rate_limit_reset_interval) {
            $resetTime = $this->last_used_at->addSeconds($this->rate_limit_reset_interval);
            return now()->greaterThan($resetTime);
        }

        return true;
    }

    /**
     * Registra el uso de la API
     */
    public function registerUsage(): void
    {
        $this->last_used_at = now();
        $this->save();
    }

    /**
     * Construye una URL completa para la API
     */
    public function buildUrl(string $endpoint): string
    {
        return rtrim($this->base_url, '/') . '/' . ltrim($endpoint, '/');
    }

    /**
     * Obtiene los headers necesarios para la API
     */
    public function getHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];
    }
}
