<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'ingredients';

    public $timestamps = false; // solo existe updated_at manual

    protected $fillable = [
        'name',
        'description',
        'category',
        'brand',
        'type',
        'unit',
        'is_alcoholic',
        'alcohol_content',
        'parent_ingredient_id',
        'flavor_profile_tags',
        'attributes',
        'source_api_id',
        'user_id', // agregado para ingredientes privados del usuario
    ];

    protected $casts = [
        'is_alcoholic' => 'boolean',
        'flavor_profile_tags' => 'array',
        'attributes' => 'array',
    ];

    // Relación al usuario dueño (nullable => ingredientes globales)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene la API fuente de este ingrediente
     */
    public function sourceApi(): BelongsTo
    {
        return $this->belongsTo(SourceApi::class, 'source_api_id');
    }

    /**
     * Obtiene los ingredientes hijos de este ingrediente
     */
    public function childIngredients(): HasMany
    {
        return $this->hasMany(Ingredient::class, 'parent_ingredient_id');
    }

    /**
     * Obtiene el ingrediente padre
     */
    public function parentIngredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class, 'parent_ingredient_id');
    }

    /**
     * Obtiene las recetas que usan este ingrediente
     */
    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(recipe::class, 'recipe_ingredients')
                    ->withPivot(['amount','unit']);
    }

    /**
     * Obtiene los usuarios que tienen este ingrediente en su inventario
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_ingredients')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    /**
     * Obtiene las relaciones del modelo de manera no estática
     */
    public function getModelRelations()
    {
        return $this->getRelations();
    }
}
