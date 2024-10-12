# Projeto Relacionamento Aula 11/10

- php artisan make:migration create_produto_table

$table->id();
$table->foreignId('cat_id')->constrained('categoria')->onDelete('cascade');
$table->string('prod_nome');
$table->integer('prod_quantidade');
$table->text('prod_descricao')->nullable();
$table->timestamps();

- php artisan migrate

### Migration Apenas cria a tabela no banco

# Model = Para o banco saber que existe uma tabela com o nome do model
- php artisan make:model Produto

- protected $table = 'produto'; = Para Falar pro banco o nome da tabela

-protected $fillable = ['cat_id', 'prod_nome', 'prod_quantidade', 'prod_descricao'];

    // Relacionamento com Categoria (Na tabela/Model produto)
    public function categoria()
    {
        // belongsTo = para 1
        return $this->belongsTo(Categoria::class, 'cat_id');
    }

    // Relacionamento com Produto (Na tabela/Model Categoria)
    public function produtos()
    {
        // HasMany = Muitos
        return $this->hasMany(Produto::class, 'cat_id');
    }

# Controller app/http/controllers/
- php artisan make:controller ProdutoController
## Imports
- use App\Models\Produto;
- use App\Models\Categoria;

     public function index()
    {
        $produtos = Produto::with('categoria')->get();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cat_id' => 'required|exists:categorias,id',
            'prod_nome' => 'required|string|max:255',
            'prod_quantidade' => 'required|integer',
            'prod_descricao' => 'nullable|string',
        ]);

        Produto::create($request->all());
        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();
        return view('produtos.edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'cat_id' => 'required|exists:categorias,id',
            'prod_nome' => 'required|string|max:255',
            'prod_quantidade' => 'required|integer',
            'prod_descricao' => 'nullable|string',
        ]);

        $produto->update($request->all());
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto removido com sucesso!');
    }

    $produtos = Produto::all();
    dd($produtos);

# Route
- Route::get('/produto',[ProdutoController::class, 'index']);

# Trazendo Informação do id cat_id com o nome da categoria

                                // Nome da função do model
        $produtos = Produto::with('categoria')->get();

# Pegando apenas o nome do produto
- echo $produtos[1]->prod_nome;
- echo $produtos[1]->categoria->cat_nome;

# Mudando View Produto.inde

- Pegando o Foreach e o Modal

# Alterando no ProdutoController
- return view('produtos.index');
- return view('produto.index', compact('produtos'));

# aLTERANDO PAGINA INDEX DE PRODUTO
- <th>Categoria</th>
-  @foreach ($produtos as $linha)
- <td>{{ $linha->prod_nome }}</td>
- <td>{{ $linha->categoria->cat_nome }}</td>

 <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="prod_nome">
                            <label for="floatingInput">Nome do Produto</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="prod_descricao">
                            <label for="floatingInput">Descrição do Produto</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="prod_quantidade">
                            <label for="floatingInput">Quantidade</label>
                        </div>

# Colocando Categoria no index de produto

<select class="form-select" aria-label="Default select example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>

$categorias = Categoria::all();
return view('produto.index', compact('produtos','categorias'));

 @foreach($categorias as $item)
    <option value="3">{{ $item->cat_nome }}</option>
@endforeach

<option value="{{$item->id}}">{{ $item->cat_nome }}</option>


 public function SalvarNovoProduto(Request $request)

Route::post('/produto',[ProdutoController::class, 'SalvarNovoProduto'])->name('produto_novo');

<form action=" {{ route('produto_novo') }}" method="POST">
<select class="form-select" aria-label="Default select example" name="cat_id">




