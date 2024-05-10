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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id'); // Añadir la columna usuario_id (clave foránea)
            $table->unsignedBigInteger('categoria_id'); // Añadir la columna categoria_id (clave foránea)
            $table->string('titulo');
            $table->text('imagen');
            $table->text('descripcion');
            $table->date('fecha');
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade'); // Establecer la relación con la tabla usuarios
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade'); // Establecer la relación con la tabla categorias

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
