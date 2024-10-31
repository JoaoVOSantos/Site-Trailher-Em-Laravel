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

                    <button class="btn mb-3 btn-success" data-toggle="modal" data-target="#modalPagamento">Comprar</button>


                </div>

                <!-- Modal de Comprar -->
                <div class="modal fade" id="modalPagamento" tabindex="-1" aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-fullscreen-md-down modal-md modal-dialog-centered" role="document">
                        <div class="modal-content p-4 bg-white text-black">
                            <div class="modal-header mx-auto border-0">
                                <h2 class="modal-title fs-3 fw-normal text-black">Pagamento com Cartão</h2>
                            </div>
                            <div class="modal-body">
                                <div class="payment-detail">
                                    <div class="payment-form p-0">
                                        <div class="col-lg-12 mx-auto">
                                            <form id="payment-form" method="POST" action="{{ route('comprar') }}">
                                                @csrf

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingCardholderName" name="cardholderName" placeholder="Nome do Titular" required>
                                                    <label for="floatingCardholderName">Nome do Titular do Cartão</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingCardNumber" name="cardNumber" placeholder="Número do Cartão" required>
                                                    <label for="floatingCardNumber">Número do Cartão</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingExpiration" name="cardExpiration" placeholder="MM/AA" required>
                                                    <label for="floatingExpiration">Data de Expiração (MM/AA)</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingCVV" name="securityCode" placeholder="Código de Segurança" required>
                                                    <label for="floatingCVV">Código de Segurança (CVV)</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="email" class="form-control" id="floatingEmail" name="payerEmail" placeholder="Email do Pagador" required>
                                                    <label for="floatingEmail">Email do Pagador</label>
                                                </div>

                                                <div class="modal-footer mt-5 d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-outline-success">Confirmar Pagamento</button>
                                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
        @else
        <p class="text-center text-white mt-4">Seu carrinho está vazio.</p>
        @endif
    </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const mp = new MercadoPago("TEST-bda95783-3688-4260-9f6a-6a9c29bf4631"); // Substitua pela sua chave pública

        const paymentForm = document.getElementById("payment-form");

        paymentForm.addEventListener("submit", function(event) {
            event.preventDefault(); // Previne o envio do formulário até que o token seja gerado

            const cardData = {
                cardNumber: document.getElementById("floatingCardNumber").value,
                expirationMonth: document.getElementById("floatingExpiration").value.split('/')[0], // Mês
                expirationYear: "20" + document.getElementById("floatingExpiration").value.split('/')[1], // Ano (4 dígitos)
                securityCode: document.getElementById("floatingCVV").value,
                cardholderName: document.getElementById("floatingCardholderName").value,
            };

            mp.createCardToken(cardData).then(function(response) {

                console.log(response); // Adicione isso para ver a resposta do token
                if (response.id) {
                    const tokenInput = document.createElement("input");
                    tokenInput.setAttribute("type", "hidden");
                    tokenInput.setAttribute("name", "token");
                    tokenInput.setAttribute("value", response.id); // Adiciona o token ao formulário
                    paymentForm.appendChild(tokenInput);

                    paymentForm.submit(); // Envia o formulário com o token
                } else {
                    alert("Erro ao processar o cartão. Verifique as informações.");
                }
            }).catch(function(error) {
                alert("Erro ao processar o cartão. Tente novamente.");
            });
        });
    });
</script>


@endsection