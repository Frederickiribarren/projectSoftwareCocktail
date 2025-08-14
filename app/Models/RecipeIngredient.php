<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    use HasFactory;

    protected $table = 'recipe_ingredients';

    protected $fillable = [
        'recipe_id',
        'ingredient_id',
        'amount',
        'unit',
    ];

    /**
     * Obtiene la receta asociada
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Obtiene el ingrediente asociado
     */
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
