@extends('admin_template.index')

@section('conteudo')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Categorias</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Listagem de Categorias</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Pesquisa de Categorias
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Opçoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $linha)
                            <tr>
                                <td>{{ $linha->id }}</td>
                                <td>{{ $linha->cat_nome }}</td>
                                <td>Editar | Excluir</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
