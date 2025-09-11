<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');
            $table->timestamps();
        });

        DB::table('projects')->insert([
            'name' => 'Proyecto 1',
            'description' => 'Descripción del proyecto',
            'start_date' => '2025-09-11',
            'end_date' => '2025-12-31',
            'status' => 'activo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
