@extends('cliente_template.index')

@section('conteudo')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <section class="food_section layout_padding text-white">
        <div class="heading_container heading_center">
            <h2>Seu Carrinho</h2>
        </div>

        <div class="filters-content">
            <div class="row grid">
                @if (session('carrinho'))
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
                                    @php $totalCarrinho = 0; @endphp <!-- Inicializa a variável total -->
                                    @foreach (session('carrinho') as $id => $item)
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
                                                                    {{ $produtoItem->pro_nome }}
                                                                </h5>
                                                                <h6>
                                                                    <p>
                                                                        <strong>Ingredientes</strong><br>
                                                                        @foreach ($produtoItem->ingrediente as $itemIngrediente)
                                                                            {{ $itemIngrediente->ing_nome }} |
                                                                        @endforeach
                                                                    </p>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            @endforeach
                                            <td class="py-2">R$ {{ number_format($item['pro_preco'], 2, ',', '.') }}</td>
                                            <td class="py-2">{{ $item['quantidade'] }}</td>
                                            <td class="py-2">R$
                                                @php
                                                    $totalItem = $item['pro_preco'] * $item['quantidade'];
                                                    $totalCarrinho += $totalItem; // Acumula o total
                                                @endphp
                                                {{ number_format($totalItem, 2, ',', '.') }}
                                            </td>

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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="text-center mt-4">
                                <p>Total: R$ {{ number_format($totalCarrinho, 2, ',', '.') }}</p> <!-- Exibe o total do carrinho -->
                                <form action="{{ route('comprar') }}" id="paymentForm" method="POST">
                                    @csrf
                                    <input type="hidden" id="totalInput" name="total" value="{{ $totalCarrinho }}">
                                    <button class="btn mb-3 btn-success" type="submit">Comprar</button>
                                </form>
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
