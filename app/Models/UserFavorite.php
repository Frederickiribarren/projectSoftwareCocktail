<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model
{
    use HasFactory;

    /**
     * Las reglas de validación para los favoritos de usuario
     */
    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'recipe_id' => 'required|exists:recipes,id',
    ];

    protected $table = 'user_favorites';

    protected $fillable = [
        'user_id',
        'recipe_id',
    ];

    /**
     * Obtiene el usuario asociado
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene la receta asociada
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Verifica si una receta es favorita para un usuario
     *
     * @param int $userId
     * @param int $recipeId
     * @return bool
     */
    public static function isFavorite($userId, $recipeId)
    {
        return static::where('user_id', $userId)
            ->where('recipe_id', $recipeId)
            ->exists();
    }

    /**
     * Toggle el estado de favorito de una receta
     *
     * @param int $userId
     * @param int $recipeId
     * @return array
     */
    public static function toggleFavorite($userId, $recipeId)
    {
        $favorite = static::where('user_id', $userId)
            ->where('recipe_id', $recipeId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return ['status' => 'removed'];
        }

        static::create([
            'user_id' => $userId,
            'recipe_id' => $recipeId
        ]);
        return ['status' => 'added'];
    }
}
