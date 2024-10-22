<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = "produto";
    protected $fillable = ['tip_id','pro_nome','pro_preco','pro_descricao'];

    public function tipoproduto(){
        return $this->belongsTo(TipoProduto::class, 'tip_id');
    }

    public function pedido(){
        return $this->belongsToMany(Pedido::class, 'produdopedido');
    }

    public function ingrediente()
    {
        return $this->belongsToMany(Ingrediente::class, 'ingredienteativo')
                    ->withPivot('ativo');  // Inclui o campo adicional 'ativo' da tabela pivot
    }

}
