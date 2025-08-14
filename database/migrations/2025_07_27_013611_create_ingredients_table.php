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
        Schema::disableForeignKeyConstraints();

        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique()->index();
            $table->text('description')->nullable();
            $table->string('category')->index()->default('Sin categorizar');  // Spirits, Licores, Jugos, Mixers, etc.
            $table->string('brand')->nullable();  // Marca específica (ej: Hendrick's, Tanqueray)
            $table->string('type')->nullable();   // Tipo específico dentro de la categoría
            $table->string('unit')->nullable();   // Unidad de medida (oz, ml, etc)
            $table->boolean('is_alcoholic')->index()->default(false);
            $table->decimal('alcohol_content', 5, 2)->nullable(); // Alcohol By Volume (renombrado de abv)
            $table->unsignedBigInteger('parent_ingredient_id')->nullable();
            $table->foreign('parent_ingredient_id')->references('id')->on('ingredients');
            $table->json('flavor_profile_tags')->nullable();
            $table->json('attributes')->nullable(); // Para almacenar metadatos adicionales
            $table->string('source_api_id', 255)->index()->nullable();
            $table->boolean('is_premium')->default(false); // Para ingredientes premium
            $table->boolean('is_verified')->default(false); // Para ingredientes verificados
            $table->string('image_url')->nullable(); // URL de la imagen del ingrediente
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('ingredients');
    }
};
