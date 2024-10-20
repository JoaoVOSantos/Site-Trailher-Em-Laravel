<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $table = "endereco";
    protected $fillable = ['end_rua','end_numero','end_bairro','end_cep','end_complemento'];

    
}
