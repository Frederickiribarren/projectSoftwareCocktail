<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            // Índices para mejorar el rendimiento de consultas
            $table->index(['is_private', 'created_at'], 'idx_recipes_privacy_date');
            $table->index('name', 'idx_recipes_name');
            $table->index('glass_type', 'idx_recipes_glass_type');
            $table->index(['user_id', 'is_private'], 'idx_recipes_user_privacy');
        });

        Schema::table('ingredients', function (Blueprint $table) {
            $table->index('name', 'idx_ingredients_name');
            $table->index('is_alcoholic', 'idx_ingredients_alcoholic');
        });

        Schema::table('recipe_ingredients', function (Blueprint $table) {
            $table->index(['recipe_id', 'ingredient_id'], 'idx_recipe_ingredient_lookup');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropIndex('idx_recipes_privacy_date');
            $table->dropIndex('idx_recipes_name');
            $table->dropIndex('idx_recipes_glass_type');
            $table->dropIndex('idx_recipes_user_privacy');
        });

        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropIndex('idx_ingredients_name');
            $table->dropIndex('idx_ingredients_alcoholic');
        });

        Schema::table('recipe_ingredients', function (Blueprint $table) {
            $table->dropIndex('idx_recipe_ingredient_lookup');
        });
    }
};
