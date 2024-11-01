@extends('cliente_template.index')
@section('conteudo')

<div class="col-md-6 mx-auto mt-5">
    <div class="box bg-white shadow-md rounded-lg p-4">
        <div class="img-box flex justify-center mb-4">
        </div>
        <div class="detail-box text-center">
            <h5 class="text-2xl font-bold text-green-600 mb-4">
                Pagamento Efetuado com Sucesso!! <br>
                Seu pedido esta em Preparação!!!
            </h5>
            <div class="d-flex justify-content-center gap-3 b-3">
                <a href="{{ route('carrinho') }}" class="btn btn-danger">Voltar Para Carrinho</a>
                <a href="{{ route('cardapio') }}" class="btn btn-success ">Voltar para Produtos</a>
            </div>
        </div>
    </div>
</div>


@endsection