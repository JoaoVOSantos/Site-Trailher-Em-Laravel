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
        Schema::create('produto', function (Blueprint $table) {
            $table->id();
            // 
            $table->foreignId('cat_id')->constrained('categoria')->onDelete('cascade');
            $table->string('prod_nome'); //String 255 caracteres
            $table->integer('prod_quantidade');
            $table->text('prod_descricao')->nullable(); //Text 250000 caracteres
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto');
    }
};
