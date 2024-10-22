<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredienteativo extends Model
{
    use HasFactory;

    protected $table = 'ingredienteativo';
    protected $fillable = [
        'produto_id',
        'ingrediente_id',
        'ativo',
    ];
    
    public function produto(){
        return $this->belongsToMany(Produto::class, 'ingredienteativo');
    }
    
}
