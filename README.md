# Aula 08 - 20/09/2024
- CRUD

## Projeto CRUD
    - Categoria
    - Produto

### Configurações
    - Banco de Dados
        - config/database.php
         -  'default' => env('DB_CONNECTION', 'mysql'),
         - .env
         - DB_CONNECTION=mysql
         - DB_DATABASE=CRUD
    - Template
        - Css, Javascript vão na Pasta Public
        - Index.html como Index.blae.php
        - Fez a Route para o index
        - php artisan serve
    - Adicionando o template
        - Index.blade.php
        - @yield()
        - @extends()
        - @section()
### Criando o CRUD
    - Migration
        - php artisan make:migration create_categoria_table
            - Criando Tabelas e campos
            - php artisan migrate
    - Model
        - php artisan make:model Categoria
        - app/Models/Categoria.php
    - Controller
        -Inserir, Alterar, Update, Delete
        - php artisan make:controller categoriaController
        - app/http/controllers/categoriasController.php
    - Route
        - Rota -> Controller -> View
    - View



