<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ingredient_id')->constrained()->onDelete('cascade');
            $table->decimal('quantity', 8, 2)->default(0);
            $table->string('unit')->default('ml'); // ml, oz, unidades, etc.
            $table->date('expiry_date')->nullable();
            $table->decimal('minimum_stock')->nullable();
            $table->boolean('notify_low_stock')->default(false);
            $table->json('notes')->nullable();
            $table->timestamps();

            // Índice único para evitar duplicados
            $table->unique(['user_id', 'ingredient_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_inventory');
    }
};
