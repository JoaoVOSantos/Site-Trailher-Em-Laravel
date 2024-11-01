<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        Usuario::create(['usu_nome' => 'Administrador',
                                     'usu_email' => 'admin@admin',
                                     'usu_senha' => Hash::make('1jGkAtT91'),
                                     'usu_admin' => 1,
        ]);
        Usuario::create(['usu_nome' => 'Usuario Comum',
                                     'usu_email' => 'usuario@usuario',
                                     'usu_senha' => Hash::make('12345678'),
                                     'usu_admin' => 0,
        ]);
    }
}
