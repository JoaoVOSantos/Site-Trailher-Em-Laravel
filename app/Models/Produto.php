<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    // Fala que tabela existe
    protected $table = 'produto';
    // Fala que tabela possui esses campos
    protected $fillable = ['cat_id', 'prod_nome', 'prod_quantidade', 'prod_descricao'];

    // Relacionamento com Categoria
    public function categoria()
    {
        // retorna                       // Model                      Campo do relacionamento
        return $this->belongsTo(Categoria::class, 'cat_id');
    }
}
