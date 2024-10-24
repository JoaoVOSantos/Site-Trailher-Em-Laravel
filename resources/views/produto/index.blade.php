@extends('admin_template.index')

@section('conteudo')
<div class="container-fluid px-4">
    <h1 class="mt-4">Produtos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Listagem de Produtos</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Pesquisa de Produto
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Novo
                        Produto</a>
                </div>
            </div>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Descricao</th>
                        <th>Tipo Produto</th>
                        <th>Ingredientes</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produto as $linha)
                    <tr>
                        <td>{{ $linha->id }}</td>
                        <td>{{ $linha->pro_nome }}</td>
                        <td>{{ $linha->pro_preco }}</td>
                        <td>{{ $linha->pro_descricao }}</td>
                        <td>{{ $linha->tipoproduto->tip_nome }}</td>
                        <td>
                            @foreach ($linha->ingrediente as $ingredientes)

                            {{ $ingredientes->ing_nome }} <br>

                            @endforeach
                        </td>
                        <td>

                            <a href='{{ route('pro_alterar', ["id"=>$linha->id ]) }}' class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil"> </i>
                            </a>

                            |

                            <a href="{{ route('pro_excluir', ["id"=>$linha->id ]) }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"> </i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="/produto" method="POST">
                @csrf <!-- Sempre colocar quando usar forms-->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="pro_nome">
                        <label for="floatingInput">Nome</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" min="0" step="0.01" class="form-control" name="pro_preco">
                        <label for="floatingInput">Preço</label>
                    </div>

              
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="pro_descricao" max="255">
                        <label for="floatingInput">Descrição</label>
                    </div>
               

                <!-- select de tipo produto -->
                
                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Default select example" name="tip_id">
                            <option value="0">Selecione um Tipo de Produto</option>
                            @foreach ($tipoproduto_todos as $item)
                            <option value="{{ $item->id }}">{{ $item->tip_nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="floatingInput">Selecione os Ingredientes</label>
                    @foreach ($ingrediente_todos as $item)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $item->id }}" name="ingrediente_id[]">
                        <label class="form-check-label" for="ingrediente_{{ $item->id }}">
                            {{ $item->ing_nome }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection