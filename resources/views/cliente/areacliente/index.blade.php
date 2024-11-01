@extends("cliente_template.index")

@section("conteudo")

<div class="container mx-auto mt-5">
    <div class="col-md-8 mx-auto">
        <div class="box bg-white shadow-lg rounded-lg p-6">
            <div class="d-flex justify-content-center gap-3">
                <div class="row w-100">

                    <div class="col-md-6 p-5">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{route('salvarNovosDados')}}" method="POST">
                            @csrf <!-- Sempre colocar quando usar forms-->
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Altere seu Usuario</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="usu_nome" value="{{ Auth::user()->usu_nome }}">
                                    <label for="floatingInput">Nome</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="usu_senha" value="">
                                    <label for="floatingInput">Senha</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="usu_email" value="{{Auth::user()->usu_email}}">
                                    <label for="floatingInput">Email</label>
                                </div>
                                <label for="floatingInput">Selecione um Endereço</label>
                                @foreach ($enderecos as $item)
                                @if (
                                $usuario->endereco->contains(function ($endereco) use ($item) {
                                return $endereco->id === $item->id;
                                }))
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                                        name="end_id[]" checked>
                                    <label class="form-check-label" value="{{ $item->id }}">
                                        {{ $item->end_rua }} - {{$item->end_bairro}} - {{$item->end_numero}}
                                    </label>
                                </div>
                                @else
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                                        name="end_id[]">
                                    <label class="form-check-label" value="{{ $item->id }}">
                                        {{ $item->end_rua }} - {{$item->end_bairro}} - {{$item->end_numero}}
                                    </label>
                                </div>
                                @endif
                                @endforeach

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 p-5">
                        <form action="{{route('SalvarNovoEndereco')}}" method="POST">
                            @csrf <!-- Sempre colocar quando usar forms-->
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cadastre seu Endereço</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="end_rua" value="">
                                    <label for="floatingInput">Nome da Rua</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" name="end_numero" required>
                                    <label for="floatingInput">Numero da Casa</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="end_bairro" required>
                                    <label for="floatingInput">Bairro</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" name="end_cep" required>
                                    <label for="floatingInput">CEP</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="end_complemento">
                                    <label for="floatingInput">Complemento</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection