@extends('admin_template.index')

@section('conteudo')
<div class="container-fluid px-4">
    <h1 class="mt-4">Usuarios</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Listagem de Usuarios</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Pesquisa de usuarios
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Novo
                        Usuario</a>
                </div>
            </div>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Senha</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Endereço</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $linha)
                    <tr>
                        <td>{{ $linha->id }}</td>
                        <td>{{ $linha->usu_nome }}</td>
                        <td>{{ $linha->usu_senha }}</td>
                        <td>{{ $linha->usu_email }}</td>
                        <td>@if($linha->usu_admin == 1) Sim @else Não @endif</td>
                        <td>
                            @foreach ($linha->endereco as $endereco)
                            {{ $endereco->end_rua }} - {{ $endereco->end_numero }} - {{ $endereco->end_bairro }}<br>
                            @endforeach
                        </td>

                        <td>

                            <a href='{{ route('usu_alterar', ["id"=>$linha->id ]) }}' class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil"> </i>
                            </a>

                            |

                            <a href="{{ route('usu_excluir', ["id"=>$linha->id ]) }}" class="btn btn-danger btn-sm">
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

            <form action="/usuario" method="POST">
                @csrf <!-- Sempre colocar quando usar forms-->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="usu_nome">
                        <label for="floatingInput">Nome</label>
                    </div>


                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="usu_senha">
                        <label for="floatingInput">Senha</label>
                    </div>


                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="usu_email">
                        <label for="floatingInput">Email</label>
                    </div>
                    <label for="floatingInput">Admin?</label>
                    <div class="form-floating mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="usu_admin" value="1" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="usu_admin" value="0" id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Não
                                </label>
                            </div>
                    </div>
                <label for="floatingInput">Selecione um Endereço</label>
                @foreach ($enderecos as $item)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $item->id }}" name="end_id[]">
                    <label class="form-check-label" value="{{ $item->id }}">
                        {{ $item->end_rua }}
                    </label>
                </div>
                @endforeach

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection