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
        Schema::create('categoria', function (Blueprint $table) {
            $table->id(); // Inteiro - Chave Primaria - Auto Increment
            $table->string("cat_nome");
            $table->string("cat_descricao")->nullable(); // nullable = pode ser vazio
            $table->boolean("cat_ativo")->default(1); // Exclusao logica
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria');
    }
};
