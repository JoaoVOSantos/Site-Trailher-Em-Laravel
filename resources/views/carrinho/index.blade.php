@extends('cliente_template.index')

@section('conteudo')
<section class="food_section layout_padding text-white">
    <div class="heading_container heading_center">
        <h2>Seu Carrinho</h2>
    </div>

    <div class="filters-content">
        <div class="row grid">
            @if(session('carrinho'))
            <div class="col-md-12 col-lg-8 mx-auto">
                <div class="box rounded-md">
                    <table class="table table-striped text-white">
                        <thead class="border-b-2 border-white">
                            <tr class="text-left">
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Total</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session('carrinho') as $id => $item)
                            <tr>
                                @foreach ($produto as $produtoItem)
                                @if ($produtoItem->id == $id)
                                <td class="col-md-6">
                                    <div class="box">
                                        <div class="img-box">
                                            <img src="images/f2.png" alt="">
                                        </div>
                                        <div class="detail-box">
                                            <h5>
                                                {{$produtoItem->pro_nome}}
                                            </h5>
                                            <h6>
                                                <p>
                                                    <strong>Ingredientes</strong><br>
                                                    @foreach ($produtoItem->ingrediente as $itemIngrediente)
                                                    {{$itemIngrediente->ing_nome}} |
                                                    @endforeach
                                                </p>
                                            </h6>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </td>

                                <td class="py-2">R$ {{ $item['pro_preco'] }}</td>
                                <td class="py-2">{{ $item['quantidade'] }}</td>
                                <td class="py-2">R$ {{ $item['pro_preco'] * $item['quantidade'] }}</td>


                                <td>
                                    <form action="{{ route('carrinho.update', $id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-danger">-</button>
                                    </form>
                                    <form action="{{ route('carrinho.add', $id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success">+</button>
                                    </form>
                                </td>
                </div>
                </tr>
                @endforeach
                </tbody>

                </table>

                <div class="text-center mt-4">
                    <button class="btn btn-primary mb-3">Comprar</button>
                </div>
            </div>
        </div>
        @else
        <p class="text-center text-white mt-4">Seu carrinho está vazio.</p>
        @endif
    </div>
    </div>
</section>
@endsection