@extends('admin_template.index')

@section('conteudo')
<div class="container-fluid px-4">
    <h1 class="mt-4">Pedidos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Listagem de Pedido</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Pesquisa de Pedido
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Novo
                        Pedido</a>
                </div>
            </div>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome Do Usuario</th>
                        <th>Valor</th>
                        <th>Quantidade</th>
                        <th>Status do Pagamento</th>
                        <th>Data do Pagamento</th>
                        <th>Endereço</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedido as $linha)
                    <tr>
                        <td>{{ $linha->id }}</td>
                        <td>{{ $linha->usuario->usu_nome }}</td>
                        <td>{{ $linha->ped_valor }}</td>
                        <td>{{ $linha->ped_quantidade}}</td>
                        @if($linha->ped_status == 1)
                        <td>Pago</td>
                        @else
                        <td>Aguardando Pagamento</td>
                        @endif
                        <td>{{ $linha->ped_data_pago }}</td>
                        <td>
                            @foreach ($linha->usuario->endereco as $item)
                            {{ $item->end_rua }} - {{ $item->end_numero }} - {{ $item->end_bairro }} <br>
                            @endforeach
                        </td>
                        <td>

                            <a href='{{ route('ped_alterar', ["id"=>$linha->id ]) }}' class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil"> </i>
                            </a>

                            |

                            <a href="{{ route('ped_excluir', ["id"=>$linha->id ]) }}" class="btn btn-danger btn-sm">
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

            <form action="/pedido" method="POST">
                @csrf <!-- Sempre colocar quando usar forms-->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <select class="form-select" name="usuario_id" id="usuario_id">
                            <option value="">Selecione um usuario</option>
                            @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">
                                {{ $usuario->usu_nome }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" min="0" step="0.01" class="form-control" name="ped_valor">
                        <label for="floatingInput">Valor do Pedido</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" min="0" step="0.01" class="form-control" name="ped_data">
                        <label for="floatingInput">Data do Pagamento</label>
                    </div>

                    <label for="floatingInput">Pago?</label>
                    <div class="form-floating mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ped_status" value="1" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Sim
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ped_status" value="0" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Não
                            </label>
                        </div>
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