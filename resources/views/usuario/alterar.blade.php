@extends('admin_template.index')

@section('conteudo')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Usuario</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Alteração de usuario</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                alterar Usuario
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('usu_alt_salva') }}" method="POST">
                        @csrf <!-- Sempre colocar quando usar forms-->
                        <input type="hidden" name="id" value="{{ $usuario->id }}" />

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="usu_nome" value="{{ $usuario->usu_nome }}">
                            <label for="floatingInput">Nome do Usuario</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="usu_senha" value="{{ $usuario->usu_senha }}">
                            <label for="floatingInput">Senha do Usuario</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="usu_email" value="{{ $usuario->usu_email }}">
                            <label for="floatingInput">Email</label>
                        </div>
                        <label for="floatingInput">Admin?</label>
                        @if ($usuario->usu_admin == 0)
                            <div class="form-floating mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="usu_admin" value="1"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Sim
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="usu_admin" value="0"
                                        id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Não
                                    </label>
                                </div>
                            </div>
                        @endif
                        @if ($usuario->usu_admin == 1)
                            <div class="form-floating mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="usu_admin" value="1"
                                        id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Sim
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="usu_admin" value="0"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Não
                                    </label>
                                </div>
                            </div>
                        @endif

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
                                        {{ $item->end_rua }}
                                    </label>
                                </div>
                            @else
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                                        name="end_id[]">
                                    <label class="form-check-label" value="{{ $item->id }}">
                                        {{ $item->end_rua }}
                                    </label>
                                </div>
                            @endif
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
