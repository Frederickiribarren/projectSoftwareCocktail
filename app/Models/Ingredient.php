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

    protected $fillable = [
        'name',
        'description',
        'is_alcoholic',
        'parent_ingredient_id',
        'flavor_profile_tags',
        'source_api_id',
    ];

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
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients')
                    ->withPivot(['amount', 'unit'])
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
