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
        Schema::create('user', function (Blueprint $table) {
            $table->id();  // Este es un campo de clave primaria autoincremental
            $table->string('username')->unique();  // Asegura unicidad en el nombre de usuario
            $table->string('password');
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->timestamp('created_at')->useCurrent();  // Se crea automáticamente con el registro
            $table->timestamp('updated_at')->nullable();  // Permite valores nulos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
