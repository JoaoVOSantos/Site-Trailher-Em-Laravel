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
        Schema::create('endereco', function (Blueprint $table) {
            $table->id();
            $table->string('end_rua');
            $table->integer('end_numero');
            $table->string('end_bairro');
            $table->integer('end_cep');
            $table->text('end_complemento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endereco');
    }
};
