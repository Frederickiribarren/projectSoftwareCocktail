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
            $table->boolean('is_alcoholic')->index()->default(DEFAULT : false);
            $table->unsignedBigInteger('parent_ingredient_id')->nullable();
            $table->foreign('parent_ingredient_id')->references('id')->on('ingredients');
            $table->json('flavor_profile_tags')->nullable();
            $table->string('source_api_id', 255)->index()->nullable();
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
