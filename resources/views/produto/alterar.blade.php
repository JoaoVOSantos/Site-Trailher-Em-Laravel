@extends('admin_template.index')

@section('conteudo')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Produtos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Alteração de Produto</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Alterar Produto
            </div>
            <div class="card-body">
                <div class="row">

                    <form action="{{ route('prod_alt_salva') }}" method="POST">
                        @csrf <!-- Sempre colocar quando usar forms-->
                        <input type="hidden" name="id" value="{{ $produtos->id }}" />
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="prod_nome" value="{{$produtos->prod_nome}}">
                            <label for="floatingInput">Nome do Produto</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="prod_descricao" value="{{$produtos->prod_descricao}}">
                            <label for="floatingInput">Descrição do Produto</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" name="cat_id">
                                <option value="0">Selecione uma categoria</option>
                                @foreach ($categorias as $item)
                                    <option value="{{ $item->id }}">{{ $item->cat_nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <input type="submit" class="btn btn-success" value="SALVAR">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
