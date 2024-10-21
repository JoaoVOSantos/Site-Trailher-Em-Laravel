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
        Schema::create('produtopedido', function (Blueprint $table) {
            
            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')->references('id')->on('pedido')->onDelete('cascade');

            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->references('id')->on('produto')->onDelete('cascade');
            
            $table->primary(['pedido_id', 'produto_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtopedido');
    }
};
