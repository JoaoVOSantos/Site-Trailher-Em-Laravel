<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;

    protected $table = "ingrediente";
    protected $fillable = ['ing_nome'];

    public function produto()
    {
        return $this->belongsToMany(Produto::class, 'ingredienteativo')
                    ->withPivot('ativo') ; // Inclui o campo adicional 'ativo' da tabela pivot
    }

}
