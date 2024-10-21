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
        Schema::create('ingredienteativo', function (Blueprint $table) {
            $table->unsignedBigInteger('ingrediente_id');
            $table->foreign('ingrediente_id')->references('id')->on('ingrediente')->onDelete('cascade');

            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->references('id')->on('produto')->onDelete('cascade');

            $table->boolean('ativo')->default(true);
            $table->primary(['ingrediente_id', 'produto_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredienteativo');
    }
};
