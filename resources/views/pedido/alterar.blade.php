@extends('admin_template.index')

@section('conteudo')
<div class="container-fluid px-4">
    <h1 class="mt-4">Pedido</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Alteração de Pedido</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            alterar Pedido
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{ route('ped_alt_salva') }}" method="POST">
                    @csrf <!-- Sempre colocar quando usar forms-->
                    <input type="hidden" name="id" value="{{ $pedido->id }}" />

                    <!-- select fazer -->

                    <div class="form-floating mb-3">
                        
                        <select class="form-select" name="usuario_id" id="usuario_id">
                            @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ $pedido->usuario_id == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->usu_nome }}
                            </option>
                            @endforeach
                        </select>
                        <label value="">Selecione o Usuário</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" min="0" step="0.01" class="form-control" name="ped_valor" value="{{ $pedido->ped_valor }}">
                        <label for="floatingInput">Valor do Pedido</label>
                    </div>

                    <!-- Radio Button -->
                    <label for="floatingInput">Pago?</label>
                        @if ($pedido->ped_status == 0)
                            <div class="form-floating mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ped_status" value="1"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Sim
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ped_status" value="0"
                                        id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Não
                                    </label>
                                </div>
                            </div>
                        @else
                            <div class="form-floating mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ped_status" value="1"
                                        id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Sim
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ped_status" value="0"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Não
                                    </label>
                                </div>
                            </div>
                        @endif
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" name="ped_data"
                                value="{{ substr($pedido->ped_data_pago, 0, 10) }}">
                            <label for="floatingInput">Data de Pagamento</label>
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