<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = "pedido";
    protected $fillable = ['usuario_id', 'ped_valor', 'ped_data_pago', 'ped_quantidade','ped_status'];


    public function usuario(){
        return $this->belongsTo(Usuario::class,'usuario_id');
    }

    public function produto(){
        return $this->belongsToMany(Produto::class, 'produtopedido');
    }

}
