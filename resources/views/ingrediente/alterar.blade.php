@extends('admin_template.index')

@section('conteudo')

<div class="container-fluid px-4">
    <h1 class="mt-4">Ingredientes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Alteração de Ingrediente</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            alterar Ingrediente
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{ route('ing_alt_salva') }}" method="POST">
                    @csrf <!-- Sempre colocar quando usar forms-->
                    <input type="hidden" name="id" value="{{ $ingrediente->id }}" />
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="ing_nome" value="{{ $ingrediente->ing_nome }}">
                            <label for="floatingInput">Nome do ingrediente</label>
                        </div>

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