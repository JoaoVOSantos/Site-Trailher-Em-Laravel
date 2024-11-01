@extends('admin_template.index')

@section('conteudo')
<div class="container-fluid px-4">
    <h1 class="mt-4">Produto</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Alteração de Produto</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            alterar Produto
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{ route('pro_alt_salva') }}" method="POST">
                    @csrf <!-- Sempre colocar quando usar forms-->
                    <input type="hidden" name="id" value="{{ $produto->id }}" />

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="pro_nome" value="{{ $produto->pro_nome }}">
                        <label for="floatingInput">Nome do Produto</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" min="0" step="0.01" class="form-control" name="pro_preco" value="{{ $produto->pro_preco }}">
                        <label for="floatingInput">Preço do Produto</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="pro_descricao" max="255" value="{{ $produto->pro_descricao }}">
                        <label for="floatingInput">Descrição</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Default select example" name="tip_id">
                            @foreach ($tiposprodutos as $item)
                            @if ($item->id == $produto->tip_id)
                            <option value="{{ $item->id }}" selected>{{ $item->tip_nome }}</option>
                            @else
                            <option value="{{ $item->id }}">{{ $item->tip_nome }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <label for="floatingInput">Selecione os Ingredientes</label>
                    @foreach ($ingredientes as $item)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $item->id }}" name="ingrediente_id[]"
                            @if ($produto->ingrediente->contains(function ($ingrediente) use ($item) {
                        return $ingrediente->pivot->ativo && $ingrediente->id === $item->id;
                        }))
                        checked
                        @endif>
                        <label class="form-check-label" for="ingrediente_{{ $item->id }}">
                            {{ $item->ing_nome }}
                        </label>
                    </div>
                    @endforeach

                    <div class="row">
                        <div class="col-md-4">
                            <input type="submit" class="btn btn-success" value="Salvar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection