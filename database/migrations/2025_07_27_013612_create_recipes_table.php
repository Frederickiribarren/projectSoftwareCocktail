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

        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->index();
            $table->text('instructions');
            $table->string('glass_type', 100)->nullable();
            $table->string('garnish', 255)->nullable();
            $table->string('image_url', 500)->nullable();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('source', ["system","user_manual","user_ocr","user_ai_generated"]);
            $table->boolean('is_private')->index()->default(DEFAULT : TRUE);
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
        Schema::dropIfExists('recipes');
    }
};
