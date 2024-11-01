<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "usuario";
    protected $fillable = ['usu_nome', 'usu_senha', 'usu_email', 'usu_admin'];


    public function endereco(){
        return $this->belongsToMany(Endereco::class,'endereco_usuario');
    }
    public function pedido(){
        return $this->hasMany(Pedido::class, 'usuario_id');
    }

}
