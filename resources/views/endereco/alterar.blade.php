@extends('admin_template.index')

@section('conteudo')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Endereços</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Alteração de Endereço</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Alterar Endereço
            </div>
            <div class="card-body">
                <div class="row">

                    <form action="{{ route(name: 'end_alt_salva') }}" method="POST">
                        @csrf <!-- Sempre colocar quando usar forms-->
                        <input type="hidden" name="id" value="{{ $endereco->id }}" />
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="end_rua" value="{{$endereco->end_rua}}">
                            <label for="floatingInput">Nome da Rua</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="end_numero" value="{{$endereco->end_numero}}">
                            <label for="floatingInput">Numero da Rua</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="end_bairro" value="{{$endereco->end_bairro}}">
                            <label for="floatingInput">Nome do Bairro</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="end_cep" value="{{$endereco->end_cep}}">
                            <label for="floatingInput">Cep</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="end_complemento" value="{{$endereco->end_complemento}}">
                            <label for="floatingInput">Complemento</label>
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
